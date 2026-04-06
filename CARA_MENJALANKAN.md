# 📘 Cara Menjalankan Buku Tamu Pernikahan (Lengkap)

Proyek ini telah dikonfigurasi menggunakan **SQLite** agar bisa dijalankan di laptop mana pun tanpa perlu setting MySQL.

---

## 💻 1. Di Laptop Saya (Gunakan Docker Sail)
Jika Anda menggunakan Docker Desktop, ikuti langkah ini:

1. **Jalankan Project**:
   ```bash
   ./vendor/bin/sail up -d
   ```
2. **Install Asset & Database**:
   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run build
   ./vendor/bin/sail artisan migrate
   ```
3. **Buka Browser**:
   Akses `http://localhost`.

---

## 🖥️ 2. Di Laptop Teman (Gunakan Laragon)
Pastikan teman Anda sudah memiliki **PHP**, **Composer**, dan **Node.js** terinstall di Laragonnya.

1. **Copy Project**:
   Pindahkan folder `Buku-Tamu-Pernikahan` ke dalam folder `C:\laragon\www\`.
2. **Setup dari Terminal**:
   Klik kanan folder proyek di Laragon, lalu pilih "Terminal":
   ```bash
   composer install
   npm install && npm run build
   php artisan migrate
   php artisan serve
   ```
3. **Buka Browser**:
   Akses `http://127.0.0.1:8000`.

---

## 🏗️ Struktur MVC (Untuk Presentasi)
Aplikasi ini sudah mengikuti konsep **MVC (Model-View-Controller)** yang bersih:

1.  **MODEL** (`app/Models/GuestbookEntry.php`):
    *   Mengatur interaksi data dengan database (SQLite).
2.  **VIEW** (`resources/views/welcome.blade.php`):
    *   Tampilan website (HMTL/CSS/JS) yang dilihat oleh tamu.
3.  **VIEW ADMIN** (`resources/views/admin.blade.php`):
    *   Tampilan tabel untuk pengelolaan data (CRUD).
4.  **CONTROLLER** (`app/Http/Controllers/GuestbookController.php`):
    *   Logika utama untuk menampilkan data, menyimpan ucapan, dan fitur admin (CRUD).
5.  **ROUTES** (`routes/web.php`):
    *   Alamat URL untuk mengakses fitur aplikasi (User & Admin).

---

## 🔒 Akses Admin Dashboard
Anda bisa mengelola, mengedit, atau menghapus ucapan tamu melalui panel admin di:
👉 **`http://localhost/admin`** (Docker) atau **`http://127.0.0.1:8000/admin`** (Laragon).
