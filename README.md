# User Admin

```
admin@admin.com
password
```

# User Dokter

```
dokter@dokter.com
password
```

# User Apoteker

```
apoteker@apoteker.com
password
```

# Logs Viewr

```
/logs
```

# Instalasi

```
cp .env.example .env (jika sudah .env maka tidak perlu lagi diubah)
composer install
php artisan key:generate
php artisan storage:link
masuk ke php.ini (apakah xampp atau laragon) lalu enable kan:
    ;extension=pdo_sqlite
    ;extension=sqlite3
php artisan migrate
php artisan db:seed
yarn install jika macbook atau npm install jika windows 
yarn build jika macbook atau npm run build jika windows
php artisan serve
```
