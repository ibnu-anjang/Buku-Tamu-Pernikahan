# Materi Presentasi — Buku Tamu Digital Pernikahan
### Konsep MVC dengan Laravel | ±10 Menit

---

## PEMBUKAAN (1 menit)

> *"Assalamualaikum / Selamat pagi/siang/sore semuanya.*
> *Perkenalkan, saya akan mempresentasikan project yang saya buat, yaitu **Buku Tamu Digital Pernikahan** berbasis website.*
> *Project ini saya bangun menggunakan framework **Laravel** dengan konsep arsitektur **MVC** — Model, View, Controller.*
> *Saya akan jelaskan bagaimana konsep MVC itu bekerja secara nyata di dalam project ini."*

---

## BAGIAN 1 — Apa Itu MVC? (2 menit)

> *"Sebelum masuk ke project-nya, saya jelaskan dulu konsep MVC secara singkat."*

**MVC adalah pola arsitektur untuk memisahkan kode menjadi 3 bagian:**

| Huruf | Nama | Tugasnya |
|---|---|---|
| M | Model | Mengurus data dan database |
| V | View | Tampilan yang dilihat pengguna |
| C | Controller | Otak — memproses logika dan menghubungkan M dan V |

> *"Analoginya seperti restoran:*
> - ***Model** = dapur, tempat data diolah*
> - ***View** = meja makan, tampilan yang dilihat tamu*
> - ***Controller** = pelayan, yang menerima pesanan, ambil dari dapur, lalu sajikan ke meja"*

**Kenapa pakai MVC?**
> *"Karena dengan MVC, kode jadi rapi, mudah dikembangkan, dan mudah diperbaiki. Kalau ada bug di tampilan, kita cukup buka View. Kalau ada masalah data, cukup buka Model. Tidak perlu cari-cari di satu file besar."*

---

## BAGIAN 2 — Demo Aplikasi (2 menit)

> *"Sekarang saya tunjukkan dulu tampilan aplikasinya."*

**Buka browser, tunjukkan:**

1. **Halaman Utama** → `http://localhost`
   > *"Ini halaman yang dilihat tamu undangan. Mereka bisa mengisi nama, nomor HP, alamat, dan ucapan selamat."*

2. **Isi form** → isi contoh data, klik kirim
   > *"Setelah dikirim, data langsung masuk ke database dan muncul di bawah sebagai ucapan tamu."*

3. **Admin Panel** → `http://localhost/admin`
   > *"Ini halaman admin. Di sini kita bisa melihat semua ucapan, mengedit, atau menghapusnya. Ini adalah fitur CRUD — Create, Read, Update, Delete."*

---

## BAGIAN 3 — Penjelasan MVC di Project Ini (4 menit)

> *"Sekarang saya jelaskan bagaimana MVC bekerja di balik layar aplikasi ini."*

---

### M — MODEL
**File:** `app/Models/GuestbookEntry.php`

> *"Model adalah representasi data kita di database. Di sini saya punya model bernama **GuestbookEntry**, yang mewakili satu baris ucapan dari tamu."*

```php
class GuestbookEntry extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'message'
    ];
}
```

> *"Dengan hanya beberapa baris kode ini, Laravel sudah bisa otomatis menyimpan, membaca, mengupdate, dan menghapus data dari tabel **guestbook_entries** di database MySQL. Inilah kecanggihan Laravel — Model tidak perlu menulis SQL manual."*

---

### V — VIEW
**File:** `resources/views/welcome.blade.php` dan `admin.blade.php`

> *"View adalah tampilan yang dilihat pengguna. Di Laravel, View dibuat dengan **Blade** — template engine yang memungkinkan kita mencampur HTML dengan kode PHP secara bersih."*

**Contoh — menampilkan ucapan tamu:**
```html
@foreach($entries as $entry)
    <p>{{ $entry->name }}</p>
    <p>{{ $entry->message }}</p>
@endforeach
```

> *"Kita cukup pakai `@foreach` dan `{{ }}` — sangat mudah dibaca. Data `$entries` ini dikirim dari Controller, bukan ditulis langsung di View."*

---

### C — CONTROLLER
**File:** `app/Http/Controllers/GuestbookController.php`

> *"Controller adalah penghubung antara Model dan View. Semua logika ada di sini."*

**Contoh — menampilkan halaman utama:**
```php
public function index()
{
    $entries = GuestbookEntry::latest()->get(); // ambil data dari MODEL
    return view('welcome', compact('entries')); // kirim ke VIEW
}
```

> *"Ketika user membuka halaman utama, Controller memanggil Model untuk ambil semua data, lalu mengirimnya ke View untuk ditampilkan."*

**Contoh — menyimpan ucapan baru:**
```php
public function store(Request $request)
{
    $validated = $request->validate([...]);   // validasi input
    GuestbookEntry::create($validated);        // simpan ke database via MODEL
    return redirect()->back()->with('success', '...'); // balik ke halaman
}
```

> *"Controller juga bertugas memvalidasi data sebelum disimpan. Kalau ada kolom yang kosong, Laravel otomatis menolak dan menampilkan pesan error."*

---

### ROUTES — Penghubung URL ke Controller
**File:** `routes/web.php`

> *"Satu lagi komponen penting: **Routes**. Routes menentukan URL mana akan ditangani oleh Controller mana."*

```php
Route::get('/', [GuestbookController::class, 'index']);       // buka halaman utama
Route::post('/guestbook', [GuestbookController::class, 'store']); // kirim ucapan

Route::prefix('admin')->group(function () {
    Route::get('/', [GuestbookController::class, 'adminIndex']);    // halaman admin
    Route::put('/{entry}', [GuestbookController::class, 'update']); // edit ucapan
    Route::delete('/{entry}', [GuestbookController::class, 'destroy']); // hapus
});
```

> *"Jadi kalau user membuka `localhost/admin`, Routes akan memanggil method `adminIndex` di Controller. Simpel dan terstruktur."*

---

## BAGIAN 4 — Alur Lengkap MVC (1 menit)

> *"Jadi alur kerja aplikasi ini dari awal sampai akhir adalah seperti ini:"*

```
User isi form dan klik KIRIM
        ↓
ROUTES → mengarahkan ke Controller
        ↓
CONTROLLER → validasi data, minta MODEL simpan ke database
        ↓
MODEL → menyimpan data ke MySQL
        ↓
CONTROLLER → redirect ke halaman utama
        ↓
CONTROLLER → minta MODEL ambil semua data
        ↓
MODEL → mengembalikan data dari database
        ↓
CONTROLLER → kirim data ke VIEW
        ↓
VIEW → menampilkan ucapan tamu di halaman
```

> *"Setiap bagian punya tugas masing-masing dan tidak saling mencampuri. Inilah keunggulan MVC."*

---

## PENUTUP (1 menit)

> *"Jadi kesimpulannya:*
> - *Project ini adalah **Buku Tamu Digital Pernikahan** yang dibangun dengan Laravel*
> - *Menggunakan konsep **MVC** untuk memisahkan data, tampilan, dan logika*
> - *Fitur lengkap: tamu bisa mengisi ucapan, admin bisa melakukan **CRUD** — tambah, lihat, edit, dan hapus data*
> - *Database menggunakan **MySQL** yang bisa dipantau lewat phpMyAdmin*
>
> *Demikian presentasi dari saya. Apabila ada pertanyaan, saya siap menjawab. Terima kasih."*

---

## ANTISIPASI PERTANYAAN

**Q: Kenapa pakai Laravel, bukan PHP biasa?**
> *"Laravel menyediakan struktur MVC secara bawaan, validasi otomatis, ORM untuk database, dan banyak fitur lain yang membuat development lebih cepat dan kode lebih rapi."*

**Q: Apa bedanya GET dan POST di Routes?**
> *"GET digunakan untuk mengambil/menampilkan data — seperti membuka halaman. POST digunakan untuk mengirim data baru — seperti mengisi form. PUT untuk mengupdate, DELETE untuk menghapus."*

**Q: Kenapa ada `$fillable` di Model?**
> *"Untuk keamanan. `$fillable` membatasi kolom mana saja yang boleh diisi dari luar, mencegah hacker menyisipkan data ke kolom yang tidak seharusnya diisi."*

**Q: Bedanya admin.blade.php dan welcome.blade.php?**
> *"welcome.blade.php adalah View untuk tamu undangan — hanya bisa mengisi. admin.blade.php adalah View untuk pengelola acara — bisa melihat semua data dan melakukan CRUD."*
