web: sh app_boot.sh
worker: php artisan queue:listen
scheduler: php -d memory_limit=512M artisan schedule:cron
