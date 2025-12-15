<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy 
                            {--skip-build : Пропустить сборку фронтенда}
                            {--message= : Кастомное сообщение для коммита}
                            {--force : Принудительная отправка (force push)}
                            {--with-seed : Выполнить seeders на сервере}
                            {--insecure : Отключить проверку SSL сертификата}
                            {--dry-run : Показать что будет сделано без выполнения}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Автоматический деплой приложения: сборка, коммит, отправка в git и уведомление сервера';

    /**
     * Git repository URL
     */
    private const REPOSITORY_URL = 'https://github.com/letoceiling-coder/glemping.git';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->info('🔍 DRY RUN MODE - команды не будут выполнены');
            $this->newLine();
        }

        try {
            // Шаг 1: Сборка фронтенда
            if (!$this->option('skip-build')) {
                $this->info('📦 Шаг 1: Сборка фронтенда...');
                if (!$dryRun) {
                    $this->buildFrontend();
                } else {
                    $this->line('  → npm run build');
                }
            } else {
                $this->info('⏭️  Пропущена сборка фронтенда (--skip-build)');
            }

            // Шаг 2: Проверка статуса Git
            $this->info('🔍 Шаг 2: Проверка статуса Git...');
            if (!$dryRun) {
                $hasChanges = $this->checkGitStatus();
                if (!$hasChanges && !$this->confirm('Нет изменений для коммита. Продолжить?', false)) {
                    $this->warn('Деплой отменен');
                    return Command::FAILURE;
                }
            } else {
                $this->line('  → git status --porcelain');
            }

            // Шаг 3: Проверка Git Remote
            $this->info('🔗 Шаг 3: Проверка Git Remote...');
            if (!$dryRun) {
                $this->ensureGitRemote();
            } else {
                $this->line('  → git remote -v');
                $this->line('  → git remote add/set-url origin ' . self::REPOSITORY_URL);
            }

            // Шаг 4: Добавление изменений в Git
            $this->info('➕ Шаг 4: Добавление изменений в Git...');
            if (!$dryRun) {
                $this->addChangesToGit();
            } else {
                $this->line('  → git add .');
            }

            // Шаг 5: Создание коммита
            $this->info('💾 Шаг 5: Создание коммита...');
            $commitMessage = $this->option('message') ?: 'Deploy: ' . date('Y-m-d H:i:s');
            if (!$dryRun) {
                $this->createCommit($commitMessage);
            } else {
                $this->line('  → git commit -m "' . $commitMessage . '"');
            }

            // Шаг 6: Отправка в репозиторий
            $this->info('📤 Шаг 6: Отправка в репозиторий...');
            if (!$dryRun) {
                $this->pushToRepository();
            } else {
                $this->line('  → git push origin <branch>' . ($this->option('force') ? ' --force' : ''));
            }

            // Шаг 7: Отправка POST запроса на сервер
            $this->info('🚀 Шаг 7: Отправка запроса на сервер...');
            if (!$dryRun) {
                $response = $this->sendDeployRequest($commitMessage);
                
                if ($response['success']) {
                    $this->newLine();
                    $this->info('✅ Деплой успешно завершен!');
                    $this->displayDeployInfo($response['data']);
                } else {
                    $this->error('❌ Ошибка деплоя на сервере: ' . $response['message']);
                    return Command::FAILURE;
                }
            } else {
                $this->line('  → POST ' . env('DEPLOY_SERVER_URL', 'https://example.com') . '/api/deploy');
                $this->line('  → Headers: X-Deploy-Token: <токен>');
            }

            return Command::SUCCESS;

        } catch (ProcessFailedException $e) {
            $this->error('Ошибка выполнения команды: ' . $e->getMessage());
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('Ошибка: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Сборка фронтенда
     */
    private function buildFrontend()
    {
        $this->line('  Выполняем: npm run build');

        $process = new Process(['npm', 'run', 'build'], base_path());
        $process->setTimeout(600); // 10 минут
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Проверяем наличие собранных файлов
        $buildDir = public_path('build');
        if (!is_dir($buildDir) || count(scandir($buildDir)) <= 2) {
            throw new \Exception('Сборка не удалась: директория public/build пуста или не существует');
        }

        $this->info('  ✅ Сборка завершена успешно');
    }

    /**
     * Проверка статуса Git
     */
    private function checkGitStatus(): bool
    {
        $process = new Process(['git', 'status', '--porcelain'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = trim($process->getOutput());

        if (empty($output)) {
            return false;
        }

        $files = explode("\n", $output);
        $this->line('  Измененные файлы:');
        foreach ($files as $file) {
            $status = substr($file, 0, 2);
            $filename = trim(substr($file, 2));
            
            // Проверка на большие файлы
            if (file_exists(base_path($filename))) {
                $size = filesize(base_path($filename));
                if ($size > 10 * 1024 * 1024) { // 10MB
                    $this->warn("  ⚠️  Большой файл: {$filename} (" . round($size / 1024 / 1024, 2) . " MB)");
                }
            }
            
            $this->line("    {$status} {$filename}");
        }

        return true;
    }

    /**
     * Проверка и настройка Git Remote
     */
    private function ensureGitRemote()
    {
        $process = new Process(['git', 'remote', '-v'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        if (strpos($output, 'origin') === false) {
            // Remote не существует, добавляем
            $this->line('  Добавляем remote origin...');
            $process = new Process(['git', 'remote', 'add', 'origin', self::REPOSITORY_URL], base_path());
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        } else {
            // Проверяем URL
            if (strpos($output, self::REPOSITORY_URL) === false) {
                $this->line('  Обновляем URL remote origin...');
                $process = new Process(['git', 'remote', 'set-url', 'origin', self::REPOSITORY_URL], base_path());
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
            }
        }

        $this->info('  ✅ Git remote настроен правильно');
    }

    /**
     * Добавление изменений в Git
     */
    private function addChangesToGit()
    {
        // Принудительно добавляем build директорию, даже если она в .gitignore
        $buildDir = public_path('build');
        if (is_dir($buildDir)) {
            $process = new Process(['git', 'add', '-f', 'public/build'], base_path());
            $process->run();
            
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }

        // Добавляем остальные изменения
        $process = new Process(['git', 'add', '.'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('  ✅ Изменения добавлены в staging area');
    }

    /**
     * Создание коммита
     */
    private function createCommit(string $message)
    {
        $process = new Process(['git', 'commit', '-m', $message], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            // Возможно, нет изменений для коммита
            $output = $process->getErrorOutput();
            if (strpos($output, 'nothing to commit') !== false) {
                $this->warn('  ⚠️  Нет изменений для коммита');
                return;
            }
            throw new ProcessFailedException($process);
        }

        $this->info('  ✅ Коммит создан: ' . $message);
    }

    /**
     * Отправка в репозиторий
     */
    private function pushToRepository()
    {
        // Определяем текущую ветку
        $process = new Process(['git', 'rev-parse', '--abbrev-ref', 'HEAD'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $branch = trim($process->getOutput());

        $this->line("  Отправляем ветку: {$branch}");

        $pushCommand = ['git', 'push'];
        
        if ($this->option('force')) {
            $pushCommand[] = '--force';
        }

        $pushCommand[] = 'origin';
        $pushCommand[] = $branch;

        $process = new Process($pushCommand, base_path());
        $process->setTimeout(300); // 5 минут
        $process->run();

        if (!$process->isSuccessful()) {
            $error = $process->getErrorOutput();
            
            // Если ошибка non-fast-forward, предлагаем force
            if (strpos($error, 'non-fast-forward') !== false && !$this->option('force')) {
                $this->error('  ❌ Ошибка: удаленная ветка содержит изменения, которых нет локально');
                $this->warn('  Используйте --force для принудительной отправки (осторожно!)');
                throw new ProcessFailedException($process);
            }
            
            throw new ProcessFailedException($process);
        }

        // Устанавливаем upstream если нужно
        $process = new Process(['git', 'branch', '--set-upstream-to=origin/' . $branch, $branch], base_path());
        $process->run(); // Игнорируем ошибку, если уже настроено

        $this->info('  ✅ Изменения отправлены в репозиторий');
    }

    /**
     * Отправка POST запроса на сервер
     */
    private function sendDeployRequest(string $commitMessage): array
    {
        $deployUrl = env('DEPLOY_SERVER_URL');
        $deployToken = env('DEPLOY_TOKEN') ?: env('DEPLOY_SECRET');

        if (!$deployUrl) {
            throw new \Exception('DEPLOY_SERVER_URL не установлен в .env');
        }

        if (!$deployToken) {
            throw new \Exception('DEPLOY_TOKEN не установлен в .env');
        }

        // Получаем commit hash
        $process = new Process(['git', 'rev-parse', 'HEAD'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $commitHash = trim($process->getOutput());

        // Определяем текущую ветку
        $process = new Process(['git', 'rev-parse', '--abbrev-ref', 'HEAD'], base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $branch = trim($process->getOutput());

        $this->line('  Отправляем запрос на: ' . $deployUrl . '/api/deploy');

        $client = Http::timeout(300) // 5 минут
            ->withHeaders([
                'X-Deploy-Token' => $deployToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => 'Glemping-Deploy/1.0',
            ]);

        if ($this->option('insecure') || app()->environment('local')) {
            $client->withoutVerifying();
        }

        $response = $client->post($deployUrl . '/api/deploy', [
            'commit_hash' => $commitHash,
            'repository' => self::REPOSITORY_URL,
            'branch' => $branch,
            'deployed_by' => get_current_user(),
            'timestamp' => date('Y-m-d H:i:s'),
            'run_seeders' => $this->option('with-seed'),
        ]);

        if ($response->failed()) {
            $status = $response->status();
            $body = $response->json();

            $errorMessage = $body['message'] ?? "HTTP {$status}";
            
            if ($status === 403) {
                throw new \Exception("Доступ запрещен: {$errorMessage}. Проверьте DEPLOY_TOKEN в .env");
            }

            throw new \Exception("Ошибка сервера ({$status}): {$errorMessage}");
        }

        return $response->json();
    }

    /**
     * Вывод информации о деплое
     */
    private function displayDeployInfo(array $data)
    {
        $this->table(
            ['Параметр', 'Значение'],
            [
                ['PHP версия', $data['php_version'] ?? 'N/A'],
                ['Ветка', $data['branch'] ?? 'N/A'],
                ['Старый commit', substr($data['old_commit_hash'] ?? 'N/A', 0, 8)],
                ['Новый commit', substr($data['new_commit_hash'] ?? 'N/A', 0, 8)],
                ['Git pull', $data['git_pull'] ?? 'N/A'],
                ['Composer install', $data['composer_install'] ?? 'N/A'],
                ['Миграции', $data['migrations']['message'] ?? 'N/A'],
                ['Seeders', $data['seeders']['message'] ?? 'N/A'],
                ['Длительность', ($data['duration_seconds'] ?? 0) . ' сек'],
                ['Завершено', $data['deployed_at'] ?? 'N/A'],
            ]
        );
    }
}

