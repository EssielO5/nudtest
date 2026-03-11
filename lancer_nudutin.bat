@echo off
cd /d C:\xampp\htdocs\nudfinal
start http://127.0.0.1:8000
call php artisan serve
pause
