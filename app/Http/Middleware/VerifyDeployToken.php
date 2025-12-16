<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyDeployToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Извлекаем токен из запроса (в порядке приоритета)
        $token = $this->extractToken($request);

        // Получаем ожидаемый токен
        $expectedToken = config('app.deploy_token') 
            ?: env('DEPLOY_TOKEN') 
            ?: env('DEPLOY_SECRET');

        // Логируем попытку проверки
        Log::info('Проверка токена деплоя', [
            'ip' => $request->ip(),
            'path' => $request->path(),
            'has_token' => !empty($token),
            'has_expected_token' => !empty($expectedToken),
        ]);

        // Проверяем наличие токена в запросе
        if (empty($token)) {
            Log::warning('Попытка деплоя без токена', [
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Токен не предоставлен',
            ], 403);
        }

        // Проверяем наличие ожидаемого токена в конфигурации
        if (empty($expectedToken)) {
            Log::error('DEPLOY_TOKEN не настроен на сервере');

            return response()->json([
                'success' => false,
                'message' => 'Серверная конфигурация не настроена',
            ], 500);
        }

        // Сравниваем токены
        if (!hash_equals($expectedToken, $token)) {
            Log::warning('Неверный токен деплоя', [
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Неверный секретный ключ',
            ], 403);
        }

        Log::info('Токен деплоя проверен успешно', [
            'ip' => $request->ip(),
        ]);

        return $next($request);
    }

    /**
     * Извлечение токена из запроса (в порядке приоритета)
     */
    private function extractToken(Request $request): ?string
    {
        // 1. Authorization Bearer
        $authHeader = $request->header('Authorization');
        if ($authHeader && preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            return $matches[1];
        }

        // 2. X-Deploy-Token header
        if ($request->hasHeader('X-Deploy-Token')) {
            return $request->header('X-Deploy-Token');
        }

        // 3. X-Deploy-Secret header (для обратной совместимости)
        if ($request->hasHeader('X-Deploy-Secret')) {
            return $request->header('X-Deploy-Secret');
        }

        // 4. token в теле запроса
        if ($request->has('token')) {
            return $request->input('token');
        }

        // 5. secret в теле запроса (для обратной совместимости)
        if ($request->has('secret')) {
            return $request->input('secret');
        }

        return null;
    }
}


