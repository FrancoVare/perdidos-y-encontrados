@echo off
title "Lost & Found Server"
set PATH=%PATH%;%CD:~0,3%php;%CD:~0,3%node
php artisan config:cache
php artisan migrate:fresh --seed
php artisan serve --port=80