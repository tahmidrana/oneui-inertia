<p align="center"><a href="https://rnd.appinionbd.com/phwc-ap" target="_blank"><img src="public/theme/media/phwc-logo.png" width="400"></a></p>

## PHWC Deployment Guide
*



### Checklist
1. Directory permissions
    * sudo chown -R $USER:www-data storage
    * sudo chown -R $USER:www-data bootstrap/cache
    * chmod -R 775 storage
    * chmod -R 775 bootstrap/cache
3. .env file config
5. composer install — optimize-autoloader — no-dev
4. php artisan storage:link
6. php artisan config:cache
7. php artisan route:cache
8. configure task scheduler/cron job for laravel
9. npm run prod
10. add certbot ssl
11. In dev/production server create a fonts folder in storage and permission 777 (for dompdf)
    * mkdir storage/fonts. chmod 777 storage/fonts
