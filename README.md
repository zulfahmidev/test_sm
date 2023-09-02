# Sistem Pemesanan Kendaraan
Sistem Pemesanan Kendaraan adalah proyek yang diberikan oleh perusahan Sekawan Media untuk menguji calon peserta magang. Masih terdapat banyak kekurangan dari sistem yang saya buat ini. Oleh karena itu, saya mohon maaf dan terimakasih atas perhatiannya.

## Tools and Version
- Mysql: 8.0.34
- Laravel: 10.10
- PHP: 8.1.2
- Composer: 2.4.4

## Users
| Fullname    |   Username  |   Password  |     Role    |
|-------------|-------------|-------------|-------------|
| Super Admin |    admin    |    admin    |    admin    |
| pimpinan 1 |    pimpinan1    |    12345    |    approver    |
| pimpinan 2 |    pimpinan2    |    12345    |    approver    |
| pimpinan 3 |    pimpinan3    |    12345    |    approver    |
| pimpinan 4 |    pimpinan4    |    12345    |    approver    |

## Instalation
1. Pastikan anda sudah menginstall tools sesuai dengan versi di atas.
2. Clone atau Download Repositori [disini](https://github.com/zulfahmidev/sm_test).
3. Setelah cloning atau extract, buka terminal pada direktori tersebut.
4. Jalankan perintah berikut untuk menginstall composer packages:

    ```
    composer install
    ```
5. Membuat database baru melalui phpmyadmin atau menggunakan terminal.
6. Konfigurasi .env, sesuai dengan user, password dan database yang sudah anda buat sebelumnya. Sebagai contoh:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_sm_test
    DB_USERNAME=fahmi
    DB_PASSWORD=password
    ```
7. Import file db_sm_test.sql ke database yang sudah anda buat sebelumnya.
8. Jalankan perintah berikut untuk menjalankan runtime laravel:

    ```
    php artisan serve
    ```
9. Jika anda menjalankan di localhost maka copy url berikut ke browser anda untuk membuka sistem pemesanan kendaraan.

    ```
    http://localhost:8000
    ```

## Login
1. Buka sistem pemesanan kendaraan.
2. Masukan username serta password sesuai dengan [daftar users](#users) di atas.