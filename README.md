# introduce

<h5>API tdc di build menggunakan framework laravel versi 8 dengan versi php 8.0, jadi pastikan versi php anda sudah diatas versi >=7, (framework laravel adalah salah satu framwork dari bahasa pemrograman php) </h5>

<h5>
aktifkan require dependancy/module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml, mbstring, curl, xml, zip, tokenizer
</h5>

```bash
#dependancy yang digunakan:
1. passport JWT
2. psr/http-message
3. oauth2-server

```

# Composer Run

```Bash
composer install
```

# Migrate Run

```Bash
php artisan migrate (wajib)
# migrate refresh ketika ada update/perubahan schema column table
php artisan migrate:refresh (optional)
# jika ingin rollback table nya jalan kan perintah di bawah ini
php artisan migrate:rollback (optional)

```

# Seeder Run

```Bash
php artisan db:seed
```

# Passport JWT install

```Bash
php artisan passport:install
```

# Start Server

```Bash
php artisan serve
```

# Test Endpoint API

```Bash
#Login
{{base_url}}/api/v1/auth/login ->POST

#baseUrl
sesuaikan dengan base url di local masing-masing. ex:http://localhost:8000 atau http://127.0.0.1:8000
akan tetapi jika ingin menggunakan base url dari server maka. ex: https://dev-api-tdc.betalogika.tech
```

# Access Ke Endpoint API Yang Menggunakan Session

<h5>jika ingin mengakses api yang menggunakan session, maka anda harus mengirimkan 2 buah object/param seperti dibawah ini, kirim kedua buah object tersebut melalui request header</h5>

<h5>Object param yang dikirim lewat request header</h5>

```JSON
{
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {{token}}",
}
```

# Test Request TDC API

```Bash

#hint
1. -H : is request header
2. -d : is request params (query,body)
3. -X : is request method (get,post,put,delete,...dst)

curl -X GET \https://dev-api-tdc.betalogika.tech => base URL

#hit login API via body/request params
curl -H 'Content-Type: application/json' \
      -d '{ "email":"dummy@gmail.com", "password": "12345678910"}' \
      -X POST \
      https://dev-api-tdc.betalogika.tech/api/v1/auth/login

#hit register API via body/request params
curl -H 'Content-Type: application/json' \
      -d '{ "name":"tdc", "email": "tdcsupport@gmail.com", "password": "12345", "password_confirmation": "12345"}' \
      -X POST \
      https://dev-api-tdc.betalogika.tech/api/v1/auth/register


#hit logout user
curl -H 'Content-Type: application/json' \
    -H 'Accept: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -X POST \
    https://dev-api-tdc.betalogika.tech/api/v1/auth/logout


#hit list master data user (for example hit api with auth/session)
#for api list use filter(search) data user, filter use params (name, email, id)
curl -H 'Accept: application/json' \
    -H 'Content-Type: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -d '{ "name":"tdc", "email": "tdcsupport@gmail.com", "id": "12345"}' \
    -X GET \
    https://dev-api-tdc.betalogika.tech/api/v1/auth/master-data/user

#hit create master data user (for example hit api with auth/session)
curl -H 'Accept: application/json' \
    -H 'Content-Type: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -d '{ "name":"tdc", "email": "tdcsupport@gmail.com", "password": "12345", "password_confirmation": "12345"}' \
    -X POST \
    https://dev-api-tdc.betalogika.tech/api/v1/auth/master-data/user

#hit update master data user (for example hit api with auth/session)
#hit update user use id (please insert id with correct)
curl -H 'Accept: application/json' \
    -H 'Content-Type: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -d '{ "name":"tdc", "email": "tdcsupport@gmail.com", "password": "12345", "password_confirmation": "12345"}' \
    -X PUT \
    https://dev-api-tdc.betalogika.tech/api/v1/auth/master-data/user/1

#hit delete master data user (for example hit api with auth/session)
#hit delete user use id (please insert id with correct)
curl -H 'Accept: application/json' \
    -H 'Content-Type: application/json' \
    -H 'Authorization: Bearer {{token}}' \
    -X DELETE \
    https://dev-api-tdc.betalogika.tech/api/v1/auth/master-data/user/1

```
