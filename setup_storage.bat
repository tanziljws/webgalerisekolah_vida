@echo off
echo ========================================
echo Setup Storage Link untuk Upload Foto
echo ========================================
echo.

cd /d "%~dp0"

echo [1/3] Membuat symbolic link storage...
php artisan storage:link

echo.
echo [2/3] Membuat folder profiles...
if not exist "storage\app\public\profiles" mkdir "storage\app\public\profiles"

echo.
echo [3/3] Set permission folder...
icacls "storage" /grant Everyone:(OI)(CI)F /T
icacls "bootstrap\cache" /grant Everyone:(OI)(CI)F /T

echo.
echo ========================================
echo Setup selesai!
echo ========================================
echo.
echo Sekarang Anda bisa upload foto profil.
echo.
pause
