# Buku Tamu Digital — Laravel Guestbook

Aplikasi buku tamu digital berbasis web yang dibangun dengan **Laravel 13** dan **MySQL/MariaDB**. Cocok digunakan sebagai referensi belajar konsep MVC pada Laravel atau sebagai starter project buku tamu pernikahan / acara.

![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)

## Fitur

- Form pengisian ucapan bagi tamu (nama, nomor telepon, alamat, pesan)
- Dashboard admin untuk mengelola seluruh ucapan (Create, Read, Update, Delete)
- Docker siap pakai — PHP 8.4 + Apache + MariaDB + phpMyAdmin
- Desain UI bertema pernikahan dengan antarmuka yang responsif

## Persyaratan

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | 8.4 |
| Composer | 2.x |
| Node.js | 18.x |
| Docker | 24.x |

## Instalasi

### Cara Cepat (Lokal tanpa Docker)

```bash
git clone https://github.com/ibnu-anjang/Buku-Tamu-Pernikahan.git
cd Buku-Tamu-Pernikahan

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate

npm install && npm run build
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000` dan panel admin di `http://127.0.0.1:8000/admin`.

### Menggunakan Docker

```bash
git clone https://github.com/ibnu-anjang/Buku-Tamu-Pernikahan.git
cd Buku-Tamu-Pernikahan

composer install
cp .env.example .env
php artisan key:generate

./start.sh
```

Script `start.sh` akan otomatis:
- Build image Docker (PHP 8.4 + Apache)
- Menjalankan MariaDB dan phpMyAdmin
- Menjalankan migrasi database
- Membangun aset frontend (jika belum ada)

| Layanan | URL |
|---------|-----|
| Aplikasi | http://localhost:8080 |
| Admin Panel | http://localhost:8080/admin |
| phpMyAdmin | http://localhost:8081 |

Login phpMyAdmin: user `root`, password `rootsecret` (lihat `.env` → `DB_ROOT_PASS`).

Untuk menghentikan:

```bash
./stop.sh
```

## Struktur Docker

```
docker/
  php/
    Dockerfile          # PHP 8.4 + Apache + ekstensi Laravel
    000-default.conf    # Apache VirtualHost → public/
docker-compose.yml      # app + db (MariaDB) + phpmyadmin
```

## Struktur Proyek (MVC)

```
app/
  Http/Controllers/
    GuestbookController.php   # Controller utama (CRUD)
  Models/
    GuestbookEntry.php        # Model data ucapan tamu
database/
  migrations/
    ..._create_guestbook_entries_table.php
resources/
  views/
    welcome.blade.php         # Halaman tamu
    admin.blade.php           # Dashboard admin
    admin_edit.blade.php      # Form edit ucapan
routes/
  web.php                     # Definisi seluruh rute
```

## Catatan Keamanan

Panel admin di `/admin` saat ini tidak dilindungi autentikasi. Untuk penggunaan di lingkungan produksi, tambahkan middleware autentikasi sebelum deployment.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE). Bebas digunakan, dimodifikasi, dan didistribusikan.
