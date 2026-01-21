# Скрипт диагностики и исправления проблемы с MySQL в OpenServer
# Запуск: powershell -ExecutionPolicy Bypass -File fix_mysql_openserver.ps1

Write-Host "=== Диагностика проблемы MySQL в OpenServer ===" -ForegroundColor Cyan
Write-Host ""

# 1. Проверка порта 3306
Write-Host "1. Проверка порта 3306..." -ForegroundColor Yellow
$port3306 = netstat -ano | findstr :3306
if ($port3306) {
    Write-Host "   [ОШИБКА] Порт 3306 занят!" -ForegroundColor Red
    Write-Host "   Занятые процессы:" -ForegroundColor Yellow
    Write-Host $port3306
} else {
    Write-Host "   [OK] Порт 3306 свободен" -ForegroundColor Green
}
Write-Host ""

# 2. Проверка процессов MySQL
Write-Host "2. Проверка процессов MySQL..." -ForegroundColor Yellow
$mysqlProcesses = tasklist | findstr /i mysql
if ($mysqlProcesses) {
    Write-Host "   [ВНИМАНИЕ] Найдены процессы MySQL:" -ForegroundColor Yellow
    Write-Host $mysqlProcesses
} else {
    Write-Host "   [OK] Процессы MySQL не найдены" -ForegroundColor Green
}
Write-Host ""

# 3. Проверка службы MySQL Windows
Write-Host "3. Проверка службы MySQL Windows..." -ForegroundColor Yellow
$mysqlService = Get-Service | Where-Object {$_.Name -like "*mysql*"}
if ($mysqlService) {
    Write-Host "   [ВНИМАНИЕ] Найдена служба MySQL Windows:" -ForegroundColor Yellow
    $mysqlService | Format-Table Name, Status, DisplayName
    Write-Host "   Рекомендация: Остановите службу MySQL Windows, если она запущена" -ForegroundColor Yellow
} else {
    Write-Host "   [OK] Служба MySQL Windows не найдена" -ForegroundColor Green
}
Write-Host ""

# 4. Определение пути к OpenServer
Write-Host "4. Поиск установки OpenServer..." -ForegroundColor Yellow
$possiblePaths = @(
    "C:\OpenServer",
    "C:\OSPanel",
    "D:\OpenServer",
    "D:\OSPanel",
    "E:\OpenServer",
    "E:\OSPanel"
)

$openserverPath = $null
foreach ($path in $possiblePaths) {
    if (Test-Path $path) {
        $openserverPath = $path
        Write-Host "   [OK] OpenServer найден: $path" -ForegroundColor Green
        break
    }
}

if (-not $openserverPath) {
    Write-Host "   [ОШИБКА] OpenServer не найден в стандартных местах" -ForegroundColor Red
    Write-Host "   Укажите путь к OpenServer вручную" -ForegroundColor Yellow
    exit 1
}

# 5. Проверка логов MySQL
Write-Host "5. Проверка логов MySQL..." -ForegroundColor Yellow
$mysqlLogPath = Join-Path $openserverPath "logs\MySQL\"
if (Test-Path $mysqlLogPath) {
    $latestLog = Get-ChildItem $mysqlLogPath -Filter "*.log" | Sort-Object LastWriteTime -Descending | Select-Object -First 1
    if ($latestLog) {
        Write-Host "   Последний лог: $($latestLog.FullName)" -ForegroundColor Cyan
        Write-Host "   Последние 20 строк лога:" -ForegroundColor Yellow
        Get-Content $latestLog.FullName -Tail 20 | ForEach-Object { Write-Host "   $_" }
    } else {
        Write-Host "   [ВНИМАНИЕ] Логи не найдены" -ForegroundColor Yellow
    }
} else {
    Write-Host "   [ВНИМАНИЕ] Папка логов не найдена: $mysqlLogPath" -ForegroundColor Yellow
}
Write-Host ""

# 6. Проверка папки данных MySQL
Write-Host "6. Проверка папки данных MySQL..." -ForegroundColor Yellow
$mysqlDataPath = Join-Path $openserverPath "modules\database\MySQL-8.0-Win10\data\"
if (Test-Path $mysqlDataPath) {
    Write-Host "   [OK] Папка данных найдена: $mysqlDataPath" -ForegroundColor Green
    
    # Проверка прав доступа
    $acl = Get-Acl $mysqlDataPath
    Write-Host "   Владелец: $($acl.Owner)" -ForegroundColor Cyan
    
    # Проверка наличия важных файлов
    $importantFiles = @("ibdata1", "ib_logfile0", "ib_logfile1", "mysql.ibd")
    foreach ($file in $importantFiles) {
        $filePath = Join-Path $mysqlDataPath $file
        if (Test-Path $filePath) {
            Write-Host "   [OK] $file существует" -ForegroundColor Green
        } else {
            Write-Host "   [ВНИМАНИЕ] $file не найден" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   [ОШИБКА] Папка данных не найдена: $mysqlDataPath" -ForegroundColor Red
}
Write-Host ""

# 7. Рекомендации
Write-Host "=== РЕКОМЕНДАЦИИ ПО ИСПРАВЛЕНИЮ ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Если служба MySQL Windows запущена:" -ForegroundColor Yellow
Write-Host "   net stop MySQL80" -ForegroundColor White
Write-Host "   или через Services.msc остановите службу MySQL"
Write-Host ""
Write-Host "2. Проверьте логи MySQL в:" -ForegroundColor Yellow
Write-Host "   $mysqlLogPath" -ForegroundColor White
Write-Host ""
Write-Host "3. Если файлы данных повреждены, попробуйте:" -ForegroundColor Yellow
Write-Host "   - Переименовать папку data в data_backup" -ForegroundColor White
Write-Host "   - Скопировать папку data из модуля MySQL-8.0-Win10 (если есть backup)" -ForegroundColor White
Write-Host "   - Или переустановить модуль MySQL в OpenServer" -ForegroundColor White
Write-Host ""
Write-Host "4. Проверьте конфигурацию my.ini в:" -ForegroundColor Yellow
$myIniPath = Join-Path $openserverPath "modules\database\MySQL-8.0-Win10"
Write-Host ("   " + $myIniPath) -ForegroundColor White
Write-Host ""
Write-Host "5. Попробуйте запустить MySQL вручную для просмотра ошибок:" -ForegroundColor Yellow
$mysqlBinPath = Join-Path $openserverPath "modules\database\MySQL-8.0-Win10\bin"
Write-Host ("   cd " + $mysqlBinPath) -ForegroundColor White
Write-Host "   mysqld.exe --console" -ForegroundColor White
Write-Host ""
