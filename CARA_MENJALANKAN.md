# Cara Menjalankan Buku Tamu Pernikahan

---

## Syarat

Pastikan **Docker Desktop** sudah terinstall dan sedang berjalan.

---

## Cara Pakai (Cukup 3 Script)

| Script | Fungsi |
|---|---|
| `./start.sh` | Jalankan aplikasi |
| `./stop.sh` | Hentikan aplikasi |
| `./db.sh` | Buka phpMyAdmin di browser |

### Pertama kali (sekali saja)
```bash
chmod +x start.sh stop.sh db.sh
```

### Jalankan
```bash
./start.sh
```

### Hentikan
```bash
./stop.sh
```

---

## Alamat Akses

| Halaman | URL |
|---|---|
| Halaman Utama | http://localhost |
| Admin Panel | http://localhost/admin |
| phpMyAdmin | http://localhost:8081 |

### Login phpMyAdmin
- **User:** `sail`
- **Password:** `password`

---

## Struktur MVC (Untuk Presentasi)

Aplikasi ini mengikuti konsep **MVC (Model-View-Controller)**:

1. **MODEL** (`app/Models/GuestbookEntry.php`) — Mengatur interaksi data dengan database MySQL.
2. **VIEW** (`resources/views/welcome.blade.php`) — Tampilan website yang dilihat tamu.
3. **VIEW ADMIN** (`resources/views/admin.blade.php`) — Tampilan tabel untuk pengelolaan data (CRUD).
4. **CONTROLLER** (`app/Http/Controllers/GuestbookController.php`) — Logika utama aplikasi.
5. **ROUTES** (`routes/web.php`) — Alamat URL untuk mengakses fitur aplikasi.
