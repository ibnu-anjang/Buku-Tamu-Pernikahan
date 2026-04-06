# 📘 Panduan Menjalankan Buku Tamu Pernikahan

File ini berisi instruksi sederhana untuk menjalankan aplikasi di dua lingkungan berbeda: **Docker (Laptop Saya)** dan **Laragon (Laptop Teman)**.

---

## 💻 1. Di Laptop Saya (Gunakan Docker)
Jika Anda menggunakan Docker Desktop, ikuti langkah ini:

1. **Siapkan Dependensi**:
   Buka terminal di folder project, lalu jalankan:
   ```bash
   docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install
   ```
2. **Nyalakan Docker (Sail)**:
   ```bash
   ./vendor/bin/sail up -d
   ```
3. **Migrasi Database**:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```
4. **Buka Browser**:
   Kunjungi [http://localhost](http://localhost).

---

## 🖥️ 2. Di Laptop Teman (Gunakan Laragon)
Jika teman Anda menggunakan Windows dengan Laragon, ikuti langkah ini:

1. **Pindah Project**:
   Copy folder `Buku-Tamu` ke dalam folder `C:\laragon\www\`.
2. **Buka Terminal di Laragon**:
   Klik kanan folder project, pilih "Open Terminal" atau "Open Folder in Terminal".
3. **Install Dependensi**:
   ```bash
   composer install
   npm install && npm run build
   ```
4. **Setup Database (SQLite)**:
   Aplikasi ini menggunakan SQLite agar teman Anda tidak perlu repot setup database MySQL di Laragon.
   Cukup pastikan file `.env` berisi:
   ```env
   DB_CONNECTION=sqlite
   ```
5. **Migrasi Database**:
   ```bash
   php artisan migrate
   ```
6. **Jalankan Aplikasi**:
   ```bash
   php artisan serve
   ```
7. **Buka Browser**:
   Kunjungi [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 🏗️ Struktur MVC (Untuk Presentasi)
Aplikasi ini sudah mengikuti konsep **MVC (Model-View-Controller)** yang bersih:

1.  **MODEL** (`app/Models/GuestbookEntry.php`):
    *   Mengatur interaksi data dengan database (SQLite).
2.  **VIEW** (`resources/views/welcome.blade.php`):
    *   Tampilan website (HMTL/CSS/JS) yang dilihat oleh tamu.
3.  **CONTROLLER** (`app/Http/Controllers/GuestbookController.php`):
    *   Logika utama untuk menampilkan data & menyimpan ucapan baru.
4.  **ROUTES** (`routes/web.php`):
    *   Alamat URL untuk mengakses fitur aplikasi.
