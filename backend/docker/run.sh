#!/bin/bash

# Khởi động PHP-FPM
php-fpm -D

# Khởi động Nginx (foreground mode)
nginx -g "daemon off;"
