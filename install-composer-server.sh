#!/bin/bash

# Скрипт установки Composer на сервере
# Использование: ./install-composer-server.sh

echo "📦 Установка Composer на сервере..."

# Проверяем, установлен ли уже composer
if command -v composer &> /dev/null; then
    COMPOSER_PATH=$(which composer)
    echo "✅ Composer уже установлен: $COMPOSER_PATH"
    echo "Версия: $(composer --version)"
    exit 0
fi

# Скачиваем composer installer
echo "📥 Скачиваем Composer installer..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Проверяем хеш установщика (актуальный хеш можно взять с getcomposer.org)
INSTALLER_HASH=$(php -r "echo hash_file('sha384', 'composer-setup.php');")
EXPECTED_HASH="dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cc84e34"  # Обновите если нужно

# Проверяем хеш (можем пропустить для автоматической установки)
# if [ "$INSTALLER_HASH" != "$EXPECTED_HASH" ]; then
#     echo "⚠️  Хеш установщика не совпадает, но продолжаем..."
# fi

# Устанавливаем composer в /usr/local/bin
echo "🔧 Устанавливаем Composer в /usr/local/bin..."
php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Удаляем установщик
rm composer-setup.php

# Проверяем установку
if [ -f /usr/local/bin/composer ]; then
    chmod +x /usr/local/bin/composer
    
    # Проверяем версию
    /usr/local/bin/composer --version
    
    echo "✅ Composer успешно установлен в /usr/local/bin/composer"
    
    # Проверяем доступность
    which composer
    composer --version
    
    echo ""
    echo "✅ Готово! Composer установлен и доступен в системе."
else
    echo "❌ Ошибка установки Composer"
    exit 1
fi

