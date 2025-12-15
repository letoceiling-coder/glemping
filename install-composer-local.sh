#!/bin/bash

# Скрипт установки Composer локально в проект
# Использование: ./install-composer-local.sh

set -e

# Определяем директорию проекта (родительская директория скрипта или текущая)
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BIN_DIR="${PROJECT_DIR}/bin"
COMPOSER_PATH="${BIN_DIR}/composer"

echo "📦 Установка Composer локально в ${BIN_DIR}..."

# Создаем директорию bin если её нет
mkdir -p "${BIN_DIR}"

# Проверяем PHP
if ! command -v php &> /dev/null; then
    echo "❌ PHP не найден. Установите PHP сначала."
    exit 1
fi

PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;")
echo "🐘 PHP версия: ${PHP_VERSION}"

# Скачиваем Composer installer
INSTALLER="${PROJECT_DIR}/composer-setup.php"
echo "📥 Скачиваем Composer installer..."
curl -sS https://getcomposer.org/installer -o "${INSTALLER}"

# Проверяем хэш установщика
EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', '${INSTALLER}');")"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    echo "❌ Ошибка: Хэш установщика не совпадает!"
    rm -f "${INSTALLER}"
    exit 1
fi

# Устанавливаем Composer
echo "📦 Устанавливаем Composer в ${COMPOSER_PATH}..."
php "${INSTALLER}" --install-dir="${BIN_DIR}" --filename="composer"

# Делаем исполняемым
chmod +x "${COMPOSER_PATH}"

# Удаляем установщик
rm -f "${INSTALLER}"

# Проверяем установку
if [ -f "${COMPOSER_PATH}" ] && [ -x "${COMPOSER_PATH}" ]; then
    echo "✅ Composer успешно установлен в ${COMPOSER_PATH}"
    "${COMPOSER_PATH}" --version
    echo ""
    echo "💡 Добавьте в .env файл:"
    echo "COMPOSER_PATH=${COMPOSER_PATH}"
else
    echo "❌ Ошибка: Composer не был установлен правильно"
    exit 1
fi

