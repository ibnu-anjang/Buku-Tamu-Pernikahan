# 💍 Premium Wedding Guestbook (Buku Tamu Digital)

Aplikasi Buku Tamu Pernikahan modern dengan konsep **Digital Invitation** yang elegan, dibangun menggunakan Laravel 11.

## ✨ Fitur Utama
- **Digital Invitation Experience**: Halaman pembuka eksklusif untuk tamu.
- **Premium UI/UX**: Desain bertema *Romantic Red & Pink* dengan aset floral dan font serif yang artistik.
- **Full CRUD Admin Dashboard**: Kelola pesan tamu (Lihat, Edit, Hapus) melalui antarmuka admin di `/admin`.
- **Zero-Config Database**: Menggunakan **SQLite**, sehingga Anda tidak perlu setup MySQL. Cukup clone dan jalankan.
- **Multi-Platform Support**: Siap dijalankan di **Docker (Laravel Sail)** maupun **Laragon (Windows/Mac)**.

## 🚀 Cara Menjalankan

### A. Menggunakan Docker (Laravel Sail) - Laptop Saya
1. **Clone Repository**:
   ```bash
   git clone git@github.com:ibnu-anjang/Buku-Tamu-Pernikahan.git
   cd Buku-Tamu-Pernikahan
   ```
2. **Install Dependensi & Jalankan**:
   ```bash
   ./vendor/bin/sail up -d
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run build
   ./vendor/bin/sail artisan migrate
   ```
3. **Akses Aplikasi**:
   - Web: `http://localhost`
   - Admin: `http://localhost/admin`

### B. Menggunakan Laragon (Windows) - Laptop Teman
1. **Persiapan**: Pastikan PHP (8.2+), Composer, dan Node.js sudah terinstall di Laragon.
2. **Setup Project**:
   ```bash
   composer install
   npm install && npm run build
   php artisan migrate
   php artisan serve
   ```
3. **Akses Aplikasi**:
   - Web: `http://127.0.0.1:8000`
   - Admin: `http://127.0.0.1:8000/admin`

## 🏗️ Struktur MVC (Gunakan untuk Presentasi)
- **Model** (`app/Models/GuestbookEntry.php`): Mengatur data di database SQLite.
- **View** (`resources/views/welcome.blade.php`): Tampilan utama tamu.
- **View Admin** (`resources/views/admin.blade.php`): Tampilan dashboard pengelola.
- **Controller** (`app/Http/Controllers/GuestbookController.php`): Logika bisnis (simpan, tampil, hapus data).

---
Dibuat oleh **Antigravity** untuk hari bahagia Anda. ❤️💍
