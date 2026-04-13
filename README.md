# Buku Tamu Digital — Laravel Guestbook

Aplikasi buku tamu digital berbasis web yang dibangun dengan **Laravel 13** dan **SQLite**. Cocok digunakan sebagai referensi belajar konsep MVC pada Laravel atau sebagai starter project buku tamu pernikahan / acara.

![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)

## Fitur

- Form pengisian ucapan bagi tamu (nama, nomor telepon, alamat, pesan)
- Dashboard admin untuk mengelola seluruh ucapan (Create, Read, Update, Delete)
- Database SQLite — tanpa konfigurasi server database tambahan
- Desain UI bertema pernikahan dengan antarmuka yang responsif
- Dukungan Docker via Laravel Sail dan instalasi lokal (Laragon/XAMPP)

## Persyaratan

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | 8.3 |
| Composer | 2.x |
| Node.js | 18.x |

## Instalasi

### Cara Cepat (Lokal)

```bash
git clone https://github.com/ibnu-anjang/Buku-Tamu-Pernikahan.git
cd Buku-Tamu-Pernikahan

composer install
cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate

npm install && npm run build
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000` dan panel admin di `http://127.0.0.1:8000/admin`.

### Menggunakan Docker (Laravel Sail)

```bash
git clone https://github.com/ibnu-anjang/Buku-Tamu-Pernikahan.git
cd Buku-Tamu-Pernikahan

composer install
cp .env.example .env
php artisan key:generate

./start.sh
```

Script `start.sh` akan menjalankan seluruh container Docker, menjalankan migrasi, dan membangun aset frontend secara otomatis.

Akses aplikasi di `http://localhost` dan panel admin di `http://localhost/admin`.

Untuk menghentikan:

```bash
./stop.sh
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
