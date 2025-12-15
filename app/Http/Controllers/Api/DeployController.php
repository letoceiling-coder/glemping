<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployController extends Controller
{
    /**
     * Выполнение деплоя
     */
    public function deploy(Request $request): JsonResponse
    {
        $startTime = microtime(true);

        Log::info('🚀 Начало деплоя', [
            'ip' => $request->ip(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        try {
            // Извлекаем данные из запроса
            $requestedBranch = $request->input('branch');
            $runSeeders = $request->boolean('run_seeders', false);

            // Определяем ветку для деплоя
            $branch = $this->determineBranch($requestedBranch);
            Log::info('🌿 Используется ветка для деплоя: ' . $branch);

            // Получаем commit hash до обновления
            $oldCommitHash = $this->getCurrentCommitHash();

            // Очистка файлов разработки (в начале)
            $this->cleanDevelopmentFiles();

            // Определяем PHP путь и версию
            $phpPath = $this->getPhpPath();
            $phpVersion = $this->getPhpVersion($phpPath);
            Log::info("🐘 PHP: {$phpVersion} ({$phpPath})");

            // 1. Git Pull
            $gitPullResult = $this->handleGitPull($branch);

            // 2. Composer Install
            $composerResult = $this->handleComposerInstall($phpPath);

            // 3. Очистка кеша package discovery
            $this->clearPackageDiscoveryCache($phpPath);

            // 4. Миграции
            $migrationsResult = $this->runMigrations($phpPath);

            // 5. Seeders (опционально)
            $seedersResult = ['status' => 'skipped', 'message' => 'Seeders пропущены (используйте --with-seed для выполнения)'];
            if ($runSeeders) {
                $seedersResult = $this->runSeeders($phpPath);
            }

            // 6. Очистка файлов разработки
            $this->cleanDevelopmentFiles();

            // 7. Очистка всех кешей
            $this->clearAllCaches($phpPath);

            // 8. Оптимизация приложения
            $this->optimizeApplication($phpPath);

            // 9. Финальная очистка файлов разработки
            $this->cleanDevelopmentFiles();

            // Получаем commit hash после обновления
            $newCommitHash = $this->getCurrentCommitHash();
            $commitChanged = $oldCommitHash !== $newCommitHash;

            $duration = round(microtime(true) - $startTime, 2);

            Log::info('✅ Деплой успешно завершен', [
                'branch' => $branch,
                'duration' => $duration,
                'commit_changed' => $commitChanged,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Деплой успешно завершен',
                'data' => [
                    'php_version' => $phpVersion,
                    'php_path' => $phpPath,
                    'branch' => $branch,
                    'old_commit_hash' => $oldCommitHash,
                    'new_commit_hash' => $newCommitHash,
                    'commit_changed' => $commitChanged,
                    'git_pull' => $gitPullResult['status'],
                    'composer_install' => $composerResult['status'],
                    'migrations' => $migrationsResult,
                    'seeders' => $seedersResult,
                    'cache_cleared' => true,
                    'optimized' => true,
                    'deployed_at' => now()->toDateTimeString(),
                    'duration_seconds' => $duration,
                ],
            ]);

        } catch (\Exception $e) {
            $duration = round(microtime(true) - $startTime, 2);

            Log::error('❌ Ошибка деплоя', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'duration' => $duration,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка деплоя: ' . $e->getMessage(),
                'data' => [
                    'error' => $e->getMessage(),
                    'trace' => config('app.debug') ? $e->getTraceAsString() : null,
                    'branch' => $request->input('branch', 'unknown'),
                    'deployed_at' => now()->toDateTimeString(),
                    'duration_seconds' => $duration,
                ],
            ], 500);
        }
    }

    /**
     * Определение ветки для деплоя
     */
    private function determineBranch(?string $requestedBranch): string
    {
        if ($requestedBranch) {
            return $requestedBranch;
        }

        // Определяем текущую ветку
        $process = new Process(['git', '-c', 'safe.directory=' . base_path(), 'rev-parse', '--abbrev-ref', 'HEAD'], base_path());
        $process->run();

        if ($process->isSuccessful()) {
            return trim($process->getOutput());
        }

        return 'main'; // Fallback
    }

    /**
     * Получение пути к PHP
     */
    private function getPhpPath(): string
    {
        // Проверяем переменную окружения
        $phpPath = env('PHP_PATH');

        if ($phpPath) {
            return $phpPath;
        }

        // Автоматически ищем PHP
        $possiblePaths = ['php8.2', 'php8.3', 'php8.1', 'php'];

        foreach ($possiblePaths as $path) {
            $process = new Process([$path, '--version'], base_path());
            $process->run();

            if ($process->isSuccessful()) {
                return $path;
            }
        }

        return 'php'; // Fallback
    }

    /**
     * Получение версии PHP
     */
    private function getPhpVersion(string $phpPath): string
    {
        $process = new Process([$phpPath, '--version'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            return 'unknown';
        }

        $output = $process->getOutput();
        if (preg_match('/PHP\s+([\d.]+)/', $output, $matches)) {
            return $matches[1];
        }

        return 'unknown';
    }

    /**
     * Git Pull
     */
    private function handleGitPull(string $branch): array
    {
        try {
            // Настройка safe directory для git
            $process = new Process([
                'git',
                'config',
                '--global',
                '--add',
                'safe.directory',
                base_path()
            ], base_path());
            $process->run();

            // Получаем текущий commit hash
            $oldHash = $this->getCurrentCommitHash();
            Log::info('📥 Commit до обновления: ' . substr($oldHash, 0, 8));

            // Проверяем локальные изменения
            $process = new Process(['git', '-c', 'safe.directory=' . base_path(), 'status', '--porcelain'], base_path());
            $process->run();

            if (trim($process->getOutput())) {
                Log::info('💾 Сохраняем локальные изменения в stash...');
                $process = new Process([
                    'git',
                    '-c',
                    'safe.directory=' . base_path(),
                    'stash',
                    'push',
                    '-m',
                    'Auto-stash before deploy ' . date('Y-m-d H:i:s')
                ], base_path());
                $process->run();
            }

            // Fetch
            Log::info("📥 Выполняем git fetch origin {$branch}...");
            $process = new Process([
                'git',
                '-c',
                'safe.directory=' . base_path(),
                'fetch',
                'origin',
                $branch
            ], base_path());
            $process->setTimeout(300);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            Log::info('✅ Git fetch выполнен успешно');

            // Reset hard
            Log::info("🔄 Выполняем git reset --hard origin/{$branch}...");
            $process = new Process([
                'git',
                '-c',
                'safe.directory=' . base_path(),
                'reset',
                '--hard',
                "origin/{$branch}"
            ], base_path());
            $process->run();

            if (!$process->isSuccessful()) {
                // Пробуем обычный pull
                Log::warning('⚠️  reset --hard не удался, пробуем обычный pull...');
                $process = new Process([
                    'git',
                    '-c',
                    'safe.directory=' . base_path(),
                    'pull',
                    'origin',
                    $branch
                ], base_path());
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
            }

            $newHash = $this->getCurrentCommitHash();
            Log::info('✅ Код успешно обновлен');
            Log::info('📥 Commit после обновления: ' . substr($newHash, 0, 8));

            return ['status' => 'success', 'message' => 'Код успешно обновлен'];

        } catch (\Exception $e) {
            Log::error('❌ Ошибка git pull: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Composer Install
     */
    private function handleComposerInstall(string $phpPath): array
    {
        try {
            // Ищем composer
            $composerPath = $this->findComposer();

            Log::info('📦 Устанавливаем зависимости через Composer...');
            
            if (!$composerPath) {
                throw new \Exception('Composer не найден. Установите composer или укажите COMPOSER_PATH в .env');
            }
            
            Log::info('📦 Composer path: ' . $composerPath);

            // Всегда используем полный путь к composer и вызываем через php
            // Это гарантирует что composer будет найден независимо от PATH
            $command = [$phpPath, $composerPath];

            $command = array_merge($command, [
                'install',
                '--no-dev',
                '--optimize-autoloader',
                '--no-interaction',
                '--no-scripts',
            ]);

            Log::info('📦 Command: ' . implode(' ', $command));

            $process = new Process($command, base_path());
            $process->setTimeout(600); // 10 минут
            $process->setEnv([
                'HOME' => getenv('HOME') ?: '/tmp',
                'COMPOSER_HOME' => getenv('COMPOSER_HOME') ?: null,
                'COMPOSER_DISABLE_XDEBUG_WARN' => '1',
            ]);

            $process->run(function ($type, $buffer) {
                Log::info($buffer);
            });

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            Log::info('✅ Composer install выполнен успешно');
            return ['status' => 'success', 'message' => 'Зависимости установлены'];

        } catch (\Exception $e) {
            Log::error('❌ Ошибка composer install: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Поиск пути к Composer (всегда возвращает полный путь)
     */
    private function findComposer(): ?string
    {
        // Проверяем переменную окружения
        $composerPath = env('COMPOSER_PATH');
        if ($composerPath && file_exists($composerPath)) {
            return realpath($composerPath) ?: $composerPath;
        }

        // Локальный composer в проекте
        $localComposer = base_path('bin/composer');
        if (file_exists($localComposer)) {
            return realpath($localComposer) ?: $localComposer;
        }

        // Стандартные пути (проверяем сначала, так как они наиболее вероятны)
        $standardPaths = [
            '/usr/local/bin/composer',
            '/usr/bin/composer',
            '/opt/composer/composer',
        ];

        foreach ($standardPaths as $path) {
            if (file_exists($path)) {
                return realpath($path) ?: $path;
            }
        }

        // Ищем через which (последний вариант)
        $process = new Process(['which', 'composer'], base_path());
        $process->run();
        if ($process->isSuccessful()) {
            $path = trim($process->getOutput());
            if ($path && file_exists($path)) {
                return realpath($path) ?: $path;
            }
        }

        // Если ничего не найдено, возвращаем null (будет ошибка)
        return null;
    }

    /**
     * Очистка кеша package discovery
     */
    private function clearPackageDiscoveryCache(string $phpPath): void
    {
        $files = [
            base_path('bootstrap/cache/packages.php'),
            base_path('bootstrap/cache/services.php'),
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $process = new Process([$phpPath, 'artisan', 'config:clear'], base_path());
        $process->run();
    }

    /**
     * Выполнение миграций
     */
    private function runMigrations(string $phpPath): array
    {
        try {
            Log::info('🗄️  Выполняем миграции...');

            $process = new Process([$phpPath, 'artisan', 'migrate', '--force'], base_path());
            $process->setTimeout(300);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            
            // Парсим количество выполненных миграций
            $migrationsRun = 0;
            if (preg_match('/(\d+)\s+migrations?\s+run/i', $output, $matches)) {
                $migrationsRun = (int) $matches[1];
            }

            Log::info("✅ Миграции выполнены: {$migrationsRun}");

            return [
                'status' => 'success',
                'message' => "Выполнено миграций: {$migrationsRun}",
                'migrations_run' => $migrationsRun,
                'output' => $output,
            ];

        } catch (\Exception $e) {
            Log::error('❌ Ошибка миграций: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'migrations_run' => 0,
            ];
        }
    }

    /**
     * Выполнение seeders
     */
    private function runSeeders(string $phpPath, ?string $class = null, bool $all = false): array
    {
        try {
            Log::info('🌱 Выполняем seeders...');

            if ($all) {
                $process = new Process([$phpPath, 'artisan', 'db:seed', '--force'], base_path());
                $process->setTimeout(600);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                Log::info('✅ Все seeders выполнены');
                return ['status' => 'success', 'message' => 'Все seeders выполнены'];

            } elseif ($class) {
                $process = new Process([
                    $phpPath,
                    'artisan',
                    'db:seed',
                    '--class=' . $class,
                    '--force'
                ], base_path());
                $process->setTimeout(300);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                Log::info("✅ Seeder {$class} выполнен");
                return ['status' => 'success', 'message' => "Seeder {$class} выполнен"];

            } else {
                // По умолчанию не выполняем seeders
                return ['status' => 'skipped', 'message' => 'Seeders не указаны'];
            }

        } catch (\Exception $e) {
            Log::error('❌ Ошибка seeders: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Очистка файлов разработки
     */
    private function cleanDevelopmentFiles(): void
    {
        $files = [
            public_path('hot'),
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    /**
     * Очистка всех кешей
     */
    private function clearAllCaches(string $phpPath): void
    {
        $commands = [
            'config:clear',
            'cache:clear',
            'route:clear',
            'view:clear',
            'optimize:clear',
        ];

        foreach ($commands as $command) {
            $process = new Process([$phpPath, 'artisan', $command], base_path());
            $process->run();
        }

        Log::info('✅ Кеши очищены');
    }

    /**
     * Оптимизация приложения
     */
    private function optimizeApplication(string $phpPath): void
    {
        $commands = [
            'config:cache',
            'route:cache',
            'view:cache',
        ];

        foreach ($commands as $command) {
            $process = new Process([$phpPath, 'artisan', $command], base_path());
            $process->run();
        }

        Log::info('✅ Приложение оптимизировано');
    }

    /**
     * Получение текущего commit hash
     */
    private function getCurrentCommitHash(): string
    {
        $process = new Process([
            'git',
            '-c',
            'safe.directory=' . base_path(),
            'rev-parse',
            'HEAD'
        ], base_path());
        $process->run();

        if ($process->isSuccessful()) {
            return trim($process->getOutput());
        }

        return 'unknown';
    }
}

