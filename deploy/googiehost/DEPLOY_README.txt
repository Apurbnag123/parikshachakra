Googiehost Deploy (Laravel)

1) Upload and extract deploy/googiehost/laravel.zip to your home directory (same level as public_html).
2) Upload and extract deploy/googiehost/public_html.zip inside public_html for domain parikshachakra.cu.ma.
3) Create .env in laravel/ (copy from laravel/.env.example) and set:
   APP_URL=https://parikshachakra.cu.ma
   PUBLIC_DISK_TO_WEBROOT=true
   DB_* values from Googiehost MySQL.
4) Ensure writable perms: laravel/storage and laravel/bootstrap/cache.

