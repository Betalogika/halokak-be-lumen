# introduce

<h5>API halokak di build menggunakan framework lumen versi 8 dengan versi php 8.0, jadi pastikan versi php anda sudah diatas versi >=7, (framework lumen adalah salah satu framwork api dari bahasa pemrograman php) </h5>

<h5>
aktifkan require module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml  dan mbstring 
</h5>

# Composer Run

```Bash
composer install
```

# Start Server

```Bash
php -S localhost:8000 -t public
```

# Migrate Run

```Bash
php artisan migrate
# migrate refresh ketika ada update/perubahan schema column table
php artisan migrate:refresh
# jika ingin rollback table nya jalan kan perintah di bawah ini
php artisan migrate:rollback

```

# Seeder Run

```Bash
php artisan db:seed
```

# Endpoint Auth API

```Bash
#baseUrl
localhost:8000 -> sesuaikan dengan base url kalian

#Login
{{base_url}}/auth/login ->POST

```

# Access Ke Endpoint API Yang Menggunakan Session

<h5>jika ingin mengakses api yang menggunakan session, maka anda harus mengirimkan 3 buah object/param seperti dibawah ini, kirim ketiga buah object tersebut melalui request header</h5>

<h5>Object param yang dikirim lewat request header</h5>

```JSON
{
    "Authorization": "Bearer {{token}}",
    "X-HALOKAK-PLATFORM": "{{platform}}",
    "X-HALOKAK-VERSION": "{{version}}"
}
```

# Test Request

```Bash

curl -X GET \https://dev-api-halokak.betalogika.tech => base URL

#hit login API via body/request params

 curl -H 'Content-Type: application/json' \
      -d '{ "email":"suryo@gmail.com", "password": "12345"}' \
      -X POST \
      https://dev-api-halokak.betalogika.tech/api/v1/mentor/auth/login

#hit register API via body/request params

 curl -H 'Content-Type: application/json' \
      -d '{ "username":"arwan", "email": "arwan_admin@gmail.com", "password": "12345", "password_confirmation": "12345"}' \
      -X POST \
      https://dev-api-halokak.betalogika.tech/api/v1/admin/auth/register

#hit logout API
curl -H 'Authorization: Bearer {{token}}' \
    -H 'X-HALOKAK-PLATFORM: web' \
    -H 'X-HALOKAK-VERSION: 1.0.0' \
    -X POST \
    https://dev-api-halokak.betalogika.tech/api/v1/user/auth/logout

curl -X POST \https://dev-api-halokak.betalogika.tech/api/v1/user/auth/logout => logout user
curl -X POST \https://dev-api-halokak.betalogika.tech/api/v1/admin/auth/logout => logout admin


```
