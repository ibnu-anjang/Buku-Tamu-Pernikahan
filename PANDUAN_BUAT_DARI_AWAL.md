# PANDUAN MEMBUAT APLIKASI BUKU TAMU PERNIKAHAN DARI AWAL
### Untuk Windows — XAMPP atau Laragon
#### (Panduan Selengkap-lengkapnya, Seperti Mengajari Anak SD)

---

## DAFTAR ISI
1. [Apa Itu MVC? Pahami Dulu!](#1-apa-itu-mvc-pahami-dulu)
2. [Persiapan: Install Tools yang Dibutuhkan](#2-persiapan-install-tools)
3. [Buat Project Laravel Baru](#3-buat-project-laravel-baru)
4. [Konfigurasi: Setting .env dan Database](#4-konfigurasi-env-dan-database)
5. [MIGRATION: Buat Struktur Tabel Database](#5-migration-buat-struktur-tabel-database)
6. [MODEL: Buat GuestbookEntry.php](#6-model-buat-guestbookentry)
7. [CONTROLLER: Buat GuestbookController.php](#7-controller-buat-guestbookcontroller)
8. [ROUTE: Daftarkan URL Aplikasi](#8-route-daftarkan-url-aplikasi)
9. [VIEW: Buat Tampilan Halaman](#9-view-buat-tampilan-halaman)
10. [CSS: Buat Tampilan Cantik](#10-css-buat-tampilan-cantik)
11. [Asset: Siapkan Gambar Background](#11-asset-siapkan-gambar-background)
12. [Build dan Jalankan Aplikasi](#12-build-dan-jalankan-aplikasi)
13. [Troubleshooting Error Umum](#13-troubleshooting-error-umum)

---

## 1. APA ITU MVC? PAHAMI DULU!

Sebelum coding, kamu harus paham dulu konsep **MVC** karena ini inti dari project ini.

MVC adalah singkatan dari **Model – View – Controller**. Bayangkan seperti sebuah restoran:

```
PELANGGAN → PELAYAN → DAPUR → PELAYAN → PELANGGAN
  (User)  (Controller) (Model)  (View)    (User)
```

### Model (M) — "Dapur / Gudang Data"
- Tugasnya: **menyimpan dan mengambil data dari database**
- File kita: `app/Models/GuestbookEntry.php`
- Contoh: "Ambilkan semua data tamu dari database"

### View (V) — "Tampilan / Dekorasi"
- Tugasnya: **menampilkan halaman HTML ke pengguna**
- File kita: `resources/views/welcome.blade.php`, `admin.blade.php`, `admin_edit.blade.php`
- Contoh: "Tampilkan daftar tamu dalam bentuk kartu yang cantik"

### Controller (C) — "Pelayan / Otak"
- Tugasnya: **menerima permintaan dari user, minta data ke Model, kirim ke View**
- File kita: `app/Http/Controllers/GuestbookController.php`
- Contoh: "User buka halaman → ambil data dari Model → kirim ke View → tampilkan ke user"

### Alur lengkapnya di project ini:
```
User buka http://127.0.0.1:8000
        ↓
   routes/web.php          ← menentukan: URL ini ditangani Controller mana
        ↓
GuestbookController        ← minta data ke Model
        ↓
GuestbookEntry (Model)     ← ambil data dari database.sqlite
        ↓
GuestbookController        ← kirim data ke View
        ↓
welcome.blade.php (View)   ← tampilkan HTML ke user
        ↓
User melihat halaman web
```

---

## 2. PERSIAPAN: INSTALL TOOLS

### PILIH SALAH SATU: XAMPP atau Laragon

---

### OPSI A: MENGGUNAKAN XAMPP

**A1. Install XAMPP:**
- Buka: https://www.apachefriends.org
- Download versi terbaru (pilih yang PHP 8.x)
- Jalankan installer, ikuti saja semua langkahnya (Next → Next → Install)
- Setelah selesai, XAMPP Control Panel akan terbuka

**A2. Tambahkan PHP ke PATH:**

PHP XAMPP ada di `C:\xampp\php`. Kita perlu daftarkan agar bisa dipakai dari mana saja.

- Tekan **Windows + S**, ketik **"environment variables"**
- Klik **"Edit the system environment variables"**
- Klik tombol **"Environment Variables..."**
- Di bagian **"System variables"**, klik **"Path"** → klik **"Edit..."**
- Klik **"New"** → ketik `C:\xampp\php`
- Klik **OK** sampai semua jendela tutup

**A3. Aktifkan ekstensi PHP di XAMPP:**
- Buka `C:\xampp\php\php.ini` dengan Notepad
- Tekan **Ctrl+H** (Find & Replace)
- Cari `;extension=pdo_sqlite` → ganti jadi `extension=pdo_sqlite`
- Cari `;extension=sqlite3` → ganti jadi `extension=sqlite3`
- Cari `;extension=mbstring` → ganti jadi `extension=mbstring`
- Cari `;extension=openssl` → ganti jadi `extension=openssl`
- Cari `;extension=fileinfo` → ganti jadi `extension=fileinfo`
- Simpan file (Ctrl+S)

---

### OPSI B: MENGGUNAKAN LARAGON

**B1. Install Laragon:**
- Buka: https://laragon.org/download
- Pilih **"Laragon Full"** (sudah include PHP, MySQL, Composer, dll)
- Jalankan installer, ikuti saja (Next → Next → Install)
- Setelah install, buka Laragon

**B2. Verifikasi PHP di Laragon:**
- Di Laragon, klik menu **"Terminal"**
- Ketik: `php --version`
- Kalau muncul `PHP 8.x.x` berarti sudah siap

> **Catatan Laragon:** Laragon biasanya sudah include Composer dan Node.js. Kalau belum, ikuti langkah install di bawah ini juga.

---

### INSTALL COMPOSER (Wajib untuk keduanya)

Composer adalah alat untuk mengelola library PHP (seperti App Store tapi untuk kode PHP).

- Buka: https://getcomposer.org/Composer-Setup.exe
- File `Composer-Setup.exe` langsung terdownload, jalankan
- Saat instalasi meminta lokasi `php.exe`:
  - XAMPP: arahkan ke `C:\xampp\php\php.exe`
  - Laragon: arahkan ke `C:\laragon\bin\php\php8.x\php.exe`
- Klik Next → Install → Finish

**Verifikasi:**
Buka Command Prompt baru → ketik `composer --version` → harus muncul versi Composer.

---

### INSTALL NODE.JS (Wajib untuk keduanya)

Node.js dipakai untuk membangun file CSS dan JavaScript tampilan.

- Buka: https://nodejs.org
- Klik tombol **"LTS"** (versi stabil)
- Jalankan installer yang terdownload → Next → Next → Install → Finish

**Verifikasi:**
Buka Command Prompt baru → ketik `node --version` → harus muncul `v22.x.x`

---

### CEK SEMUA SUDAH SIAP

Buka Command Prompt baru dan jalankan ketiga perintah ini. Semua harus menampilkan nomor versi:

```
php --version
composer --version
node --version
```

Kalau semua muncul versinya, lanjut ke langkah berikutnya!

---

## 3. BUAT PROJECT LARAVEL BARU

Sekarang kita buat project Laravel dari nol menggunakan Composer.

**a) Buka Command Prompt**

**b) Pergi ke folder tempat menyimpan project:**

Untuk XAMPP (taruh di htdocs supaya rapi):
```
cd C:\xampp\htdocs
```

Untuk Laragon (taruh di www):
```
cd C:\laragon\www
```

Atau kalau mau taruh di Documents saja juga boleh:
```
cd C:\Users\%USERNAME%\Documents
```

**c) Buat project Laravel baru:**
```
composer create-project laravel/laravel buku-tamu
```

> Perintah ini akan mendownload Laravel dan semua library yang dibutuhkan.
> Proses ini bisa 3–10 menit tergantung kecepatan internet.
> Di akhir harus ada tulisan "Application ready! Build something amazing."

**d) Masuk ke folder project:**
```
cd buku-tamu
```

> Dari sekarang, semua perintah dijalankan dari dalam folder `buku-tamu` ini!

---

## 4. KONFIGURASI .ENV DAN DATABASE

File `.env` adalah file konfigurasi aplikasi. Ini seperti "pengaturan" untuk aplikasinya.

**a) Buka file `.env`** yang ada di dalam folder `buku-tamu` menggunakan Notepad atau VS Code.

**b) Cari baris-baris ini dan ubah/pastikan isinya seperti di bawah:**

Cari bagian `DB_CONNECTION` dan ubah menjadi:
```
DB_CONNECTION=sqlite
```

Pastikan baris-baris ini di-comment (ada tanda `#` di depannya):
```
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

> Kita pakai **SQLite** karena tidak perlu install MySQL terpisah. SQLite hanyalah sebuah file di dalam project.

**c) Simpan file .env**

**d) Buat file database SQLite:**

Jalankan di Command Prompt (masih di dalam folder buku-tamu):
```
php -r "touch('database/database.sqlite');"
```

> Perintah ini membuat file kosong `database/database.sqlite`. Tidak ada output yang muncul, itu normal.

---

## 5. MIGRATION: BUAT STRUKTUR TABEL DATABASE

Migration adalah cara Laravel membuat tabel di database. Anggap saja seperti "cetak biru" tabel.

**Buat file migration baru:**
```
php artisan make:migration create_guestbook_entries_table
```

> Akan muncul pesan: `Created Migration: xxxx_xx_xx_xxxxxx_create_guestbook_entries_table`
> File baru akan dibuat di folder `database/migrations/`

**Buka file migration yang baru dibuat** (namanya ada tanggal di depannya, cari di `database/migrations/`):

File yang kamu buka isinya seperti ini (sudah ada dari Laravel):
```php
public function up(): void
{
    Schema::create('guestbook_entries', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
    });
}
```

**Ubah isi fungsi `up()` menjadi seperti ini** (tambahkan kolom-kolom yang dibutuhkan):

```php
public function up(): void
{
    Schema::create('guestbook_entries', function (Blueprint $table) {
        $table->id();
        $table->string('name');      // nama tamu
        $table->string('phone');     // nomor telepon
        $table->string('address');   // alamat
        $table->text('message');     // pesan/ucapan
        $table->timestamps();        // created_at dan updated_at otomatis
    });
}
```

**Simpan file migration.**

**Jalankan migration** (ini yang benar-benar membuat tabel di database):
```
php artisan migrate
```

> Kalau muncul pertanyaan "Do you want to create it? (yes/no)" → ketik `yes` → Enter
>
> Di akhir harus ada tulisan seperti:
> ```
>    INFO  Running migrations.
>    create_guestbook_entries_table ..... 10ms DONE
> ```

**Artinya tabel `guestbook_entries` sudah berhasil dibuat di database!**

---

## 6. MODEL: BUAT GUESTBOOKENTRY

Model adalah jembatan antara aplikasi dan database.

**Buat file Model baru:**
```
php artisan make:model GuestbookEntry
```

> File baru dibuat di: `app/Models/GuestbookEntry.php`

**Buka file `app/Models/GuestbookEntry.php`** dan ubah seluruh isinya menjadi:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MODEL: Berinteraksi dengan database.
 * Ini adalah bagian 'M' dalam MVC.
 *
 * Kelas ini merepresentasikan satu baris data di tabel 'guestbook_entries'.
 * Laravel secara otomatis tahu nama tabelnya dari nama kelas:
 * GuestbookEntry → guestbook_entries
 */
class GuestbookEntry extends Model
{
    // Kolom-kolom yang boleh diisi secara massal (mass assignment)
    // Ini penting untuk keamanan - hanya kolom ini yang bisa disimpan
    protected $fillable = [
        'name',
        'phone',
        'address',
        'message',
    ];
}
```

**Simpan file.**

---

## 7. CONTROLLER: BUAT GUESTBOOKCONTROLLER

Controller adalah otak dari aplikasi. Dia yang menghubungkan semua bagian.

**Buat file Controller baru:**
```
php artisan make:controller GuestbookController
```

> File baru dibuat di: `app/Http/Controllers/GuestbookController.php`

**Buka file tersebut dan ubah seluruh isinya menjadi:**

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestbookEntry;

/**
 * CONTROLLER: Menangani logika permintaan dari user.
 * Ini adalah bagian 'C' dalam MVC.
 */
class GuestbookController extends Controller
{
    /**
     * READ - Tampilkan halaman utama + semua pesan tamu
     * Dipanggil saat user buka: GET /
     */
    public function index()
    {
        // Ambil semua data dari tabel guestbook_entries, urut terbaru dulu
        $entries = GuestbookEntry::latest()->get();

        // Kirim data $entries ke View 'welcome', lalu tampilkan ke user
        return view('welcome', compact('entries'));
    }

    /**
     * CREATE - Simpan pesan tamu baru ke database
     * Dipanggil saat user klik submit form: POST /guestbook
     */
    public function store(Request $request)
    {
        // Validasi: pastikan semua field terisi dan tidak melebihi batas karakter
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Simpan data yang sudah divalidasi ke database melalui Model
        GuestbookEntry::create($validated);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih atas doa dan ucapannya! ❤️');
    }

    /* =====================================================
       BAGIAN ADMIN - Kelola pesan tamu
       ===================================================== */

    /**
     * READ (Admin) - Tampilkan semua pesan di panel admin
     * Dipanggil saat: GET /admin
     */
    public function adminIndex()
    {
        $entries = GuestbookEntry::latest()->get();
        return view('admin', compact('entries'));
    }

    /**
     * READ (Admin) - Tampilkan form edit untuk satu pesan
     * Dipanggil saat: GET /admin/{id}/edit
     */
    public function edit(GuestbookEntry $entry)
    {
        // $entry otomatis diisi oleh Laravel (Route Model Binding)
        return view('admin_edit', compact('entry'));
    }

    /**
     * UPDATE - Simpan perubahan pesan yang sudah diedit
     * Dipanggil saat: PUT /admin/{id}
     */
    public function update(Request $request, GuestbookEntry $entry)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $entry->update($validated);

        return redirect()->route('admin.index')->with('success', 'Pesan berhasil diperbarui!');
    }

    /**
     * DELETE - Hapus satu pesan tamu
     * Dipanggil saat: DELETE /admin/{id}
     */
    public function destroy(GuestbookEntry $entry)
    {
        $entry->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
}
```

**Simpan file.**

---

## 8. ROUTE: DAFTARKAN URL APLIKASI

Route menentukan: "Kalau user buka URL ini, panggil Controller yang mana".

**Buka file `routes/web.php`** dan ubah seluruh isinya menjadi:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestbookController;

// =====================================================
// ROUTE untuk Tamu (halaman publik)
// =====================================================

// GET / → tampilkan halaman utama (index)
Route::get('/', [GuestbookController::class, 'index'])->name('home');

// POST /guestbook → simpan pesan baru (store)
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');

// =====================================================
// ROUTE untuk Admin (halaman pengelola)
// Semua URL admin diawali dengan /admin
// =====================================================
Route::prefix('admin')->group(function () {

    // GET /admin → tampilkan daftar semua pesan
    Route::get('/', [GuestbookController::class, 'adminIndex'])->name('admin.index');

    // GET /admin/{id}/edit → tampilkan form edit pesan tertentu
    Route::get('/{entry}/edit', [GuestbookController::class, 'edit'])->name('admin.edit');

    // PUT /admin/{id} → simpan perubahan pesan
    Route::put('/{entry}', [GuestbookController::class, 'update'])->name('admin.update');

    // DELETE /admin/{id} → hapus pesan
    Route::delete('/{entry}', [GuestbookController::class, 'destroy'])->name('admin.destroy');
});
```

**Simpan file.**

---

## 9. VIEW: BUAT TAMPILAN HALAMAN

View adalah tampilan yang dilihat oleh pengguna. Kita pakai **Blade** (template engine Laravel).

### 9A. Halaman Utama Tamu (`welcome.blade.php`)

**Buka file `resources/views/welcome.blade.php`** — file ini sudah ada dari Laravel, tapi isinya kita ganti semua.

**Hapus semua isi file tersebut, ganti dengan ini:**

```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu Digital | The Wedding of ...</title>

    <!-- Vite: Load CSS dan JS yang sudah di-build -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Icons dari Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Alpine.js untuk notifikasi sukses otomatis hilang -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased scroll-smooth">

    <!-- ==========================================
         HERO / COVER SECTION
         Halaman sampul undangan digital
    =========================================== -->
    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-subtitle mb-4">You are Invited to</span>
            <h1 class="hero-title">The Wedding of</h1>
            <h2 class="text-4xl font-serif text-gold mb-8 mt-4 tracking-widest italic">Fulan & Fulanah</h2>
            <div class="w-24 h-0.5 bg-gold mx-auto mb-10"></div>
            <a href="#guestbook"
                class="bg-primary-red text-white px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-gold transition-all duration-300 shadow-xl">
                Buka Buku Tamu
            </a>
        </div>
    </header>

    <div class="main-wrapper" id="guestbook">

        <!-- ==========================================
             FORM SECTION
             Tamu mengisi nama, telepon, alamat, pesan
        =========================================== -->
        <div class="wedding-card animate-up">
            <h1 class="form-title">Tanda Kehadiran & Doa</h1>
            <p class="text-center text-gray-400 mb-8 font-serif italic">
                "Kehadiran dan doa Anda adalah anugerah terindah bagi kami."
            </p>

            {{-- Tampilkan notifikasi sukses kalau ada --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form untuk mengisi buku tamu --}}
            <form action="{{ route('guestbook.store') }}" method="POST">
                @csrf {{-- Token keamanan, wajib ada di setiap form Laravel --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input"
                            placeholder="Contoh: Budi Santoso" required
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="phone" class="form-input"
                            placeholder="Contoh: 08123456xxx" required
                            value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Kota / Alamat</label>
                    <input type="text" name="address" class="form-input"
                        placeholder="Masukkan alamat Anda" required
                        value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Ucapan & Doa Suci</label>
                    <textarea name="message" rows="4" class="form-input"
                        placeholder="Berikan doa terbaik Anda untuk kedua mempelai..."
                        required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Ucapan Suci ❤️
                </button>
            </form>
        </div>

        <!-- ==========================================
             MESSAGES FEED
             Tampilkan semua pesan tamu yang sudah masuk
             Data $entries dikirim dari Controller
        =========================================== -->
        <div class="messages-section">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px bg-gold flex-grow"></div>
                <h2 class="text-3xl text-primary-red font-bold">Untaian Doa Tamu</h2>
                <div class="h-px bg-gold flex-grow"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Loop: tampilkan setiap pesan dari $entries --}}
                @forelse($entries as $entry)
                    <div class="message-card animate-up" style="animation-delay: 0.2s">
                        <div class="message-header">
                            <span class="guest-name">{{ $entry->name }}</span>
                            <span class="guest-date">{{ $entry->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="guest-address">📍 {{ $entry->address }}</span>
                        <p class="guest-message italic mt-3">"{{ $entry->message }}"</p>
                    </div>
                @empty
                    {{-- Tampilkan ini kalau belum ada pesan sama sekali --}}
                    <div class="col-span-full text-center py-20 text-gray-400 font-serif italic">
                        Belum ada doa yang terucap. Jadilah yang pertama memberikan restu.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-20 text-center text-gray-400 py-10">
            <p class="font-serif italic">&copy; {{ date('Y') }} Fulan & Fulanah Wedding. Dibuat dengan cinta.</p>
        </footer>
    </div>

    <!-- Tombol kecil di pojok kanan bawah untuk akses Admin -->
    <a href="{{ route('admin.index') }}"
        class="fixed bottom-6 right-6 bg-white/50 backdrop-blur-sm p-3 rounded-full hover:bg-white transition-all shadow-lg text-gray-400 hover:text-primary-red"
        title="Admin Panel">
        <i data-lucide="settings" class="w-5 h-5"></i>
    </a>

    <script>
        lucide.createIcons(); // Aktifkan icon settings
    </script>
</body>

</html>
```

**Simpan file.**

---

### 9B. Halaman Admin (`admin.blade.php`)

**Buat file baru** di `resources/views/admin.blade.php`

> Caranya: di dalam folder `resources/views/`, buat file baru bernama `admin.blade.php`

**Isi file tersebut dengan ini:**

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f4f7f6; font-family: 'Inter', sans-serif; }
        .admin-container { max-width: 1000px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
        .btn-edit { color: #007bff; text-decoration: none; margin-right: 10px; font-weight: 600; }
        .btn-delete { color: #dc3545; background: none; border: none; cursor: pointer; font-weight: 600; padding: 0; }
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Admin Panel — Daftar Tamu</h1>
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-black">← Kembali ke Web</a>
        </div>

        {{-- Tampilkan notifikasi sukses --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Pesan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td><strong>{{ $entry->name }}</strong></td>
                    <td>{{ $entry->phone }}</td>
                    <td>{{ $entry->address }}</td>
                    <td class="italic">"{{ Str::limit($entry->message, 50) }}"</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.edit', $entry) }}" class="btn-edit">Edit</a>

                        {{-- Form Hapus (pakai method DELETE) --}}
                        <form action="{{ route('admin.destroy', $entry) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Yakin hapus pesan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
```

**Simpan file.**

---

### 9C. Halaman Edit Admin (`admin_edit.blade.php`)

**Buat file baru** di `resources/views/admin_edit.blade.php`

**Isi dengan ini:**

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesan - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f4f7f6; font-family: 'Inter', sans-serif; }
        .edit-container { max-width: 600px; margin: 100px auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        .form-input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; }
        .btn-update { background: #28a745; color: white; padding: 12px 30px; border-radius: 8px; border: none; cursor: pointer; width: 100%; font-weight: 700; font-size: 16px; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; }
    </style>
</head>
<body>
    <div class="edit-container">
        <a href="{{ route('admin.index') }}" class="btn-back">← Kembali ke Admin</a>
        <h1 class="text-2xl font-bold mb-6">Edit Pesan Tamu</h1>

        {{-- Form update, method PUT karena ini update data --}}
        <form action="{{ route('admin.update', $entry) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-input" value="{{ $entry->name }}" required>

            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-input" value="{{ $entry->phone }}" required>

            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-input" value="{{ $entry->address }}" required>

            <label class="form-label">Pesan</label>
            <textarea name="message" rows="5" class="form-input" required>{{ $entry->message }}</textarea>

            <button type="submit" class="btn-update">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
```

**Simpan file.**

---

## 10. CSS: BUAT TAMPILAN CANTIK

**Buka file `resources/css/app.css`** — file ini sudah ada, tapi kita ganti isinya.

**Hapus semua isi, ganti dengan ini:**

```css
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap');

/* =====================================================
   VARIABEL WARNA TEMA
   ===================================================== */
:root {
    --primary-red: #8b0000;   /* Merah tua elegan */
    --deep-red: #4a0000;      /* Merah sangat tua untuk gradient */
    --soft-pink: #fff0f5;     /* Pink lembut */
    --gold: #d4af37;          /* Emas */
    --dark: #2d2d2d;          /* Abu-abu gelap untuk teks */
}

/* =====================================================
   RESET & BASE STYLE
   ===================================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    color: var(--dark);
    line-height: 1.6;
    background-color: #fafafa;
    overflow-x: hidden;
}

/* Font serif untuk judul-judul */
h1, h2, h3, .font-serif {
    font-family: 'Playfair Display', serif;
}

/* =====================================================
   HERO SECTION (Halaman Sampul)
   ===================================================== */
.hero-section {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: url('/assets/wedding_bg.png') no-repeat center center;
    background-size: cover;
    text-align: center;
    padding: 20px;
    position: relative;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(2px);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    animation: fadeIn 1.5s ease-out;
}

.hero-title {
    font-size: 3.5rem;
    color: var(--primary-red);
    margin-bottom: 10px;
}

.hero-subtitle {
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
}

/* Warna teks emas untuk nama mempelai */
.text-gold { color: var(--gold); }
.bg-gold { background-color: var(--gold); }
.text-primary-red { color: var(--primary-red); }
.bg-primary-red { background-color: var(--primary-red); }

/* =====================================================
   MAIN CONTENT AREA
   ===================================================== */
.main-wrapper {
    max-width: 1100px;
    margin: -50px auto 100px;
    position: relative;
    z-index: 5;
    padding: 0 20px;
}

.wedding-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 50px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

/* =====================================================
   FORM STYLING
   ===================================================== */
.form-title {
    font-size: 2rem;
    color: var(--primary-red);
    text-align: center;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 0.9rem;
    color: #666;
}

.form-input {
    width: 100%;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 12px;
    transition: all 0.3s;
    background: #fdfdfd;
    font-family: 'Inter', sans-serif;
}

.form-input:focus {
    border-color: var(--gold);
    outline: none;
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
}

.btn-submit {
    background-color: var(--primary-red);
    background: linear-gradient(45deg, #4a0000, #8b0000);
    color: #ffffff;
    border: 2px solid var(--gold);
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
    border-radius: 50px;
    width: 100%;
    margin-top: 10px;
    padding: 18px;
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(74, 0, 0, 0.2);
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
}

.btn-submit:hover {
    transform: scale(1.01);
    box-shadow: 0 15px 30px rgba(74, 0, 0, 0.3);
    filter: brightness(1.1);
}

/* =====================================================
   MESSAGE FEED (Daftar pesan tamu)
   ===================================================== */
.messages-section {
    margin-top: 80px;
}

.message-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 5px solid var(--gold);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    transition: transform 0.3s;
}

.message-card:hover {
    transform: translateY(-5px);
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.guest-name {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary-red);
}

.guest-date {
    font-size: 0.8rem;
    color: #999;
}

.guest-address {
    font-size: 0.85rem;
    color: #666;
    font-style: italic;
    margin-bottom: 10px;
    display: block;
}

.guest-message {
    font-family: 'Playfair Display', serif;
    color: #444;
    font-size: 1.05rem;
}

/* =====================================================
   ANIMASI
   ===================================================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.animate-up {
    animation: fadeIn 1s ease-out;
}

/* =====================================================
   MOBILE RESPONSIVE
   ===================================================== */
@media (max-width: 768px) {
    .hero-title { font-size: 2.5rem; }
    .wedding-card { padding: 30px; }
}
```

**Simpan file.**

---

## 11. ASSET: SIAPKAN GAMBAR BACKGROUND

Halaman sampul perlu gambar background pernikahan.

**Buat folder assets di dalam public:**
- Di dalam folder project, masuk ke `public/`
- Buat folder baru bernama `assets`
- Jadi jadinya: `public/assets/`

**Masukkan gambar background:**
- Minta file `wedding_bg.png` dari pemilik project asli (atau gunakan gambar pernikahan apapun)
- Rename gambar tersebut menjadi `wedding_bg.png`
- Taruh di `public/assets/wedding_bg.png`

> **Alternatif kalau tidak punya gambarnya:** Buka `resources/css/app.css`, cari baris:
> ```css
> background: url('/assets/wedding_bg.png') no-repeat center center;
> ```
> Ganti dengan warna polos:
> ```css
> background: linear-gradient(135deg, #fff0f5, #ffe4e1);
> ```
> Tampilan tetap cantik meski tanpa gambar.

---

## 12. BUILD DAN JALANKAN APLIKASI

Semua file sudah dibuat. Sekarang saatnya menjalankan aplikasi!

Pastikan Command Prompt masih terbuka di dalam folder `buku-tamu`.

**Langkah 1 — Install library JavaScript:**
```
npm install
```
> Tunggu 1–3 menit.

**Langkah 2 — Build tampilan (CSS & JS):**
```
npm run build
```
> Harus muncul: `✓ X modules transformed.`

**Langkah 3 — Jalankan server:**
```
php artisan serve
```
> Harus muncul:
> ```
> INFO  Server running on [http://127.0.0.1:8000].
> ```

**JANGAN tutup Command Prompt ini!** Server harus tetap berjalan.

---

## 13. COBA DI BROWSER

Buka browser, ketik di address bar:

| Halaman | URL |
|---------|-----|
| Halaman Tamu | `http://127.0.0.1:8000` |
| Halaman Admin | `http://127.0.0.1:8000/admin` |

**Yang bisa dicoba:**
1. Isi form (nama, telepon, alamat, pesan) → klik "Kirim" → data tersimpan dan muncul di bawah
2. Buka halaman Admin → ada tabel semua data tamu
3. Klik "Edit" pada salah satu data → ubah → simpan
4. Klik "Hapus" → data terhapus

---

## RINGKASAN PERINTAH (Cheat Sheet)

Kalau mau jalankan dari awal lagi di lain hari:

```
cd C:\...\buku-tamu
php artisan serve
```

Kalau baru saja clone/download dan perlu setup:
```
composer install
copy .env.example .env
php artisan key:generate
php -r "touch('database/database.sqlite');"
php artisan migrate
npm install
npm run build
php artisan serve
```

---

## 14. TROUBLESHOOTING ERROR UMUM

### "php is not recognized"
Tambahkan PHP ke PATH (lihat langkah 2), lalu buka Command Prompt baru.

### "composer is not recognized"
Restart komputer setelah install Composer.

### "npm is not recognized"
Restart komputer setelah install Node.js.

### "Could not open input file: artisan"
Kamu tidak berada di dalam folder project. Jalankan:
```
cd C:\...\buku-tamu
```

### Halaman muncul tapi tidak ada CSS (tampilan polos)
Belum build assets. Jalankan:
```
npm run build
```

### "SQLSTATE[HY000]: unable to open database file"
Buat file database dulu:
```
php -r "touch('database/database.sqlite');"
php artisan migrate
```

### "No application encryption key has been specified"
```
php artisan key:generate
```

### Port 8000 sudah dipakai
```
php artisan serve --port=8080
```
Akses di: `http://127.0.0.1:8080`

### Error setelah edit kode
```
php artisan config:clear
php artisan cache:clear
```
Lalu refresh browser.

---

## STRUKTUR AKHIR PROJECT

Setelah semua selesai, struktur foldernya seperti ini:

```
buku-tamu/
├── app/
│   ├── Http/Controllers/
│   │   └── GuestbookController.php   ← CONTROLLER (kamu buat)
│   └── Models/
│       └── GuestbookEntry.php        ← MODEL (kamu buat)
├── database/
│   ├── migrations/
│   │   └── xxxx_create_guestbook_entries_table.php  ← MIGRATION (kamu buat)
│   └── database.sqlite               ← FILE DATABASE
├── public/
│   └── assets/
│       └── wedding_bg.png            ← GAMBAR BACKGROUND
├── resources/
│   ├── css/
│   │   └── app.css                   ← CSS TAMPILAN (kamu ubah)
│   └── views/
│       ├── welcome.blade.php         ← VIEW halaman tamu (kamu ubah)
│       ├── admin.blade.php           ← VIEW halaman admin (kamu buat)
│       └── admin_edit.blade.php      ← VIEW halaman edit (kamu buat)
├── routes/
│   └── web.php                       ← ROUTE URL (kamu ubah)
└── .env                              ← KONFIGURASI (kamu setting)
```

---

Semangat! Kalau ada yang bingung, baca lagi dari awal pelan-pelan. Setiap langkah penting.
