# Чек-лист проверки сервера перед деплоем

## 🔴 Критически важно

### 1. Git репозиторий настроен

```bash
cd /path/to/project

# Проверить наличие remote
git remote -v

# Должен быть origin: https://github.com/letoceiling-coder/glemping.git
# Если нет - настроить:
git remote add origin https://github.com/letoceiling-coder/glemping.git

# Проверить текущую ветку
git branch

# Инициализировать репозиторий если нужно:
git fetch origin
git checkout -b main origin/main
```

### 2. Права доступа к файлам

```bash
# Владелец файлов (обычно www-data или nginx)
sudo chown -R www-data:www-data /path/to/project

# Права на директории
sudo find /path/to/project -type d -exec chmod 755 {} \;

# Права на файлы
sudo find /path/to/project -type f -exec chmod 644 {} \;

# Права на storage и cache (обязательно!)
sudo chmod -R 775 /path/to/project/storage
sudo chmod -R 775 /path/to/project/bootstrap/cache

# Права на .env (защита от чтения)
sudo chmod 600 /path/to/project/.env
```

### 3. Переменные окружения (.env)

**Проверить наличие файла:**
```bash
ls -la /path/to/project/.env
```

**Обязательные переменные:**
```env
APP_NAME=Glemping
APP_ENV=production
APP_KEY=base64:...  # php artisan key:generate
APP_DEBUG=false
APP_URL=https://your-domain.com

# База данных
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Деплой
DEPLOY_TOKEN=your_secret_token_min_32_chars
# DEPLOY_SECRET=your_secret_token (альтернатива)

# Опционально
PHP_PATH=php8.2  # Если нужен конкретный PHP
COMPOSER_PATH=/path/to/composer  # Если composer не в PATH
```

**Создать APP_KEY если нет:**
```bash
php artisan key:generate
```

### 4. База данных

```bash
# Проверить подключение
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit

# Проверить существующие миграции
php artisan migrate:status

# Применить миграции (если нужно)
php artisan migrate
```

### 5. DEPLOY_TOKEN настроен

```bash
# В .env должен быть установлен
grep DEPLOY_TOKEN /path/to/project/.env

# Токен должен быть минимум 32 символа
# Рекомендуется сгенерировать:
openssl rand -hex 32
```

**Важно:** Токен должен совпадать с локальной машиной!

## 🟡 Важно проверить

### 6. PHP версия и расширения

```bash
# Проверить версию (нужна 8.1+)
php -v

# Или если используется конкретная версия:
php8.2 -v

# Проверить необходимые расширения:
php -m | grep -E "(pdo_mysql|mbstring|openssl|tokenizer|xml|ctype|json|bcmath|fileinfo|curl|dom|simplexml)"
```

**Требуемые расширения:**
- pdo_mysql
- mbstring
- openssl
- tokenizer
- xml
- ctype
- json
- bcmath
- fileinfo
- curl
- dom
- simplexml

### 7. Composer установлен и доступен

```bash
# Проверить наличие composer
which composer
composer --version

# Или проверить локальный composer
ls -la /path/to/project/bin/composer

# Если нет - установить локально:
mkdir -p /path/to/project/bin
curl -sS https://getcomposer.org/installer | php
mv composer.phar /path/to/project/bin/composer
chmod +x /path/to/project/bin/composer
```

### 8. Git доступен и настроен

```bash
# Проверить версию
git --version

# Настроить безопасную директорию (решает проблему dubious ownership)
git config --global --add safe.directory /path/to/project

# Проверить права на .git
ls -la /path/to/project/.git
```

### 9. Права на выполнение команд

```bash
# Проверить, может ли веб-сервер выполнять команды
# Тестовый запуск artisan команды
sudo -u www-data php artisan --version

# Проверить доступ к git
sudo -u www-data git --version

# Проверить доступ к composer
sudo -u www-data composer --version
```

### 10. Структура директорий

```bash
# Проверить наличие необходимых директорий
ls -la /path/to/project/storage
ls -la /path/to/project/bootstrap/cache
ls -la /path/to/project/public

# Создать storage links если нужно
php artisan storage:link
```

## 🟢 Рекомендуется проверить

### 11. Веб-сервер настроен

**Nginx:**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/project/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

**Apache:**
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/project/public
    
    <Directory /path/to/project/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 12. Firewall и доступ к API

```bash
# Проверить, открыт ли порт для HTTP/HTTPS
sudo ufw status
# или
sudo iptables -L

# Проверить доступность API endpoint
curl -X POST https://your-domain.com/api/deploy \
  -H "X-Deploy-Token: test" \
  -H "Content-Type: application/json" \
  -d '{"branch":"main"}'

# Должен вернуть 403 (неверный токен) или 500 (токен не настроен)
# Если 404 - маршрут не работает
```

### 13. Логи доступны для записи

```bash
# Проверить права на логи
ls -la /path/to/project/storage/logs

# Должен быть доступ на запись для веб-сервера
sudo chmod -R 775 /path/to/project/storage/logs
sudo chown -R www-data:www-data /path/to/project/storage/logs
```

### 14. Бэкап базы данных

```bash
# Создать бэкап перед первым деплоем
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
```

### 15. Тестовый деплой

**С локальной машины:**
```bash
# С dry-run сначала
php artisan deploy --dry-run

# Затем реальный деплой
php artisan deploy
```

**Проверить логи на сервере:**
```bash
tail -f /path/to/project/storage/logs/laravel.log
```

## 📋 Быстрая проверка (скрипт)

Сохраните как `check-server.sh`:

```bash
#!/bin/bash

PROJECT_PATH="/path/to/project"

echo "🔍 Проверка сервера для деплоя..."
echo ""

# 1. Git
echo "1. Git:"
cd $PROJECT_PATH
git remote -v | grep -q "glemping" && echo "  ✅ Git remote настроен" || echo "  ❌ Git remote не настроен"
git rev-parse --abbrev-ref HEAD && echo "  ✅ Ветка определена" || echo "  ❌ Ветка не определена"
echo ""

# 2. .env
echo "2. .env файл:"
[ -f "$PROJECT_PATH/.env" ] && echo "  ✅ .env существует" || echo "  ❌ .env не найден"
grep -q "DEPLOY_TOKEN=" "$PROJECT_PATH/.env" && echo "  ✅ DEPLOY_TOKEN настроен" || echo "  ❌ DEPLOY_TOKEN не настроен"
grep -q "APP_KEY=" "$PROJECT_PATH/.env" && echo "  ✅ APP_KEY настроен" || echo "  ❌ APP_KEY не настроен"
echo ""

# 3. Права
echo "3. Права доступа:"
[ -w "$PROJECT_PATH/storage" ] && echo "  ✅ storage доступен для записи" || echo "  ❌ storage не доступен для записи"
[ -w "$PROJECT_PATH/bootstrap/cache" ] && echo "  ✅ bootstrap/cache доступен для записи" || echo "  ❌ bootstrap/cache не доступен для записи"
echo ""

# 4. PHP
echo "4. PHP:"
php -v | head -1
php -m | grep -q "pdo_mysql" && echo "  ✅ pdo_mysql установлен" || echo "  ❌ pdo_mysql не установлен"
echo ""

# 5. Composer
echo "5. Composer:"
which composer > /dev/null && echo "  ✅ Composer доступен" || echo "  ❌ Composer не найден"
echo ""

# 6. База данных
echo "6. База данных:"
php artisan tinker --execute="DB::connection()->getPdo();" > /dev/null 2>&1 && echo "  ✅ Подключение к БД работает" || echo "  ❌ Ошибка подключения к БД"
echo ""

echo "✅ Проверка завершена!"
```

Использование:
```bash
chmod +x check-server.sh
./check-server.sh
```

## ⚠️ Частые проблемы

### Проблема: "dubious ownership"
```bash
# Решение:
git config --global --add safe.directory /path/to/project
```

### Проблема: "Permission denied" при git pull
```bash
# Решение: проверить владельца .git директории
sudo chown -R www-data:www-data /path/to/project/.git
```

### Проблема: Composer не найден
```bash
# Решение 1: установить локально
mkdir -p /path/to/project/bin
cd /path/to/project/bin
curl -sS https://getcomposer.org/installer | php
mv composer.phar composer
chmod +x composer

# Решение 2: указать путь в .env
echo "COMPOSER_PATH=/path/to/project/bin/composer" >> .env
```

### Проблема: 403 Forbidden при запросе
```bash
# Проверить токен в .env
grep DEPLOY_TOKEN .env

# Проверить, что токен совпадает с локальной машиной
# На локальной машине:
grep DEPLOY_TOKEN .env
```

### Проблема: Недостаточно памяти при composer install
```bash
# Увеличить memory_limit в php.ini
php -i | grep memory_limit

# Или временно:
php -d memory_limit=512M composer install
```

## ✅ Финальная проверка

После всех настроек:

1. **Тестовый запрос:**
   ```bash
   curl -X POST https://your-domain.com/api/deploy \
     -H "X-Deploy-Token: YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     -d '{"branch":"main"}'
   ```

2. **Проверить логи:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Первый деплой с локальной машины:**
   ```bash
   php artisan deploy
   ```

Если все прошло успешно - сервер готов к деплоям! 🚀


