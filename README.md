# 💍 Premium Wedding Guestbook (Buku Tamu Pernikahan)

Sebuah aplikasi Buku Tamu Pernikahan modern dengan desain elegan bertema **Romantic Red & Pink**. Aplikasi ini dirancang agar mudah dijalankan di berbagai lingkungan (Docker maupun Laragon).

## ✨ Fitur
- **Desain Premium**: Tipografi elegan, animasi halus, dan skema warna romantis.
- **Formulir Tamu**: Nama, Telepon, Alamat, dan Pesan/Doa.
- **Feed Pesan**: Daftar ucapan dari tamu yang diperbarui secara real-time.
- **Portabilitas Tinggi**: Menggunakan SQLite agar bisa langsung jalan tanpa setup database rumit.

---

## 🚀 Cara Menjalankan

### Melalui Docker (Rekomendasi untuk Linux/Mac)
Jika Anda menggunakan Docker dan Laravel Sail:

1.  **Clone repositori**:
    ```bash
    git clone <url-repo>
    cd Buku-Tamu
    ```
2.  **Install dependensi** (Jika belum ada folder vendor):
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install
    ```
3.  **Jalankan Sail**:
    ```bash
    ./vendor/bin/sail up -d
    ```
4.  **Migrasi Database**:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```
5.  **Akses Aplikasi**: Buka [http://localhost](http://localhost) di browser Anda.

---

### Melalui Laragon (Rekomendasi untuk Windows)
Jika Anda menggunakan Laragon:

1.  **Clone repositori** ke dalam folder `C:\laragon\www\Buku-Tamu`.
2.  **Buka Terminal** di folder tersebut.
3.  **Install dependensi**:
    ```bash
    composer install
    npm install && npm run build
    ```
4.  **Setup Environment**:
    Salin `.env.example` menjadi `.env` (jika belum ada). Pastikan `DB_CONNECTION=sqlite`.
5.  **Migrasi Database**:
    ```bash
    php artisan migrate
    ```
6.  **Jalankan Server**:
    ```bash
    php artisan serve
    ```
7.  **Akses Aplikasi**: Buka [http://127.0.0.1:8000](http://127.0.0.1:8000) di browser Anda.

---

## 🛠 Teknologi yang Digunakan
- **Laravel 11+**
- **SQLite** (Default DB untuk kemudahan)
- **Tailwind CSS** & Custom Premium Styling
- **Laravel Sail** (Docker Setup)
