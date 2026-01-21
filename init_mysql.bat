@echo off
chcp 65001 >nul
echo ================================================
echo  Инициализация MySQL для OpenServer
echo ================================================
echo.

REM Проверка прав администратора
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo [ОШИБКА] Запустите этот файл ОТ ИМЕНИ АДМИНИСТРАТОРА!
    echo Нажмите правой кнопкой мыши и выберите "Запуск от имени администратора"
    pause
    exit /b 1
)

set MYSQL_PATH=C:\OSPanel\modules\database\MySQL-8.0-Win10
set DATA_PATH=%MYSQL_PATH%\data
set BIN_PATH=%MYSQL_PATH%\bin

echo Проверка путей...
if not exist "%MYSQL_PATH%" (
    echo [ОШИБКА] MySQL не найден по пути: %MYSQL_PATH%
    pause
    exit /b 1
)

if not exist "%BIN_PATH%\mysqld.exe" (
    echo [ОШИБКА] mysqld.exe не найден в: %BIN_PATH%
    pause
    exit /b 1
)

echo [OK] MySQL найден
echo.

REM Проверка существования папки data
if exist "%DATA_PATH%" (
    echo [ВНИМАНИЕ] Папка data уже существует!
    echo.
    set /p confirm="Удалить существующую папку data? (y/n): "
    if /i "%confirm%"=="y" (
        echo Удаление старой папки data...
        rd /s /q "%DATA_PATH%" 2>nul
        if %errorLevel% neq 0 (
            echo [ОШИБКА] Не удалось удалить папку data. Возможно, она используется.
            echo Закройте OpenServer и попробуйте снова.
            pause
            exit /b 1
        )
        echo [OK] Папка data удалена
    ) else (
        echo Операция отменена.
        pause
        exit /b 0
    )
)

echo.
echo Инициализация MySQL...
echo Это может занять несколько минут...
echo.

cd /d "%BIN_PATH%"
mysqld.exe --initialize-insecure --datadir=%DATA_PATH%

if %errorLevel% equ 0 (
    echo.
    echo ================================================
    echo [УСПЕХ] MySQL успешно инициализирован!
    echo ================================================
    echo.
    echo Теперь вы можете:
    echo 1. Запустить OpenServer
    echo 2. Подключиться к MySQL через phpMyAdmin
    echo 3. Использовать root без пароля для первого входа
    echo.
) else (
    echo.
    echo ================================================
    echo [ОШИБКА] Не удалось инициализировать MySQL
    echo ================================================
    echo.
    echo Проверьте логи в: C:\OSPanel\logs\MySQL\
    echo.
)

pause
