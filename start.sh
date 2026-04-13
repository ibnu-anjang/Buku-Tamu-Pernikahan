#!/bin/bash

# ============================================
# Script Menjalankan Buku Tamu Pernikahan
# ============================================

PROJECT_DIR="$(cd "$(dirname "$0")" && pwd)"
SAIL="$PROJECT_DIR/vendor/bin/sail"

cd "$PROJECT_DIR"

echo "======================================"
echo "  Buku Tamu Pernikahan - MULAI"
echo "======================================"

# Cek Docker berjalan
if ! docker info > /dev/null 2>&1; then
    echo "[X] Docker tidak berjalan!"
    echo "    Buka Docker Desktop terlebih dahulu, lalu coba lagi."
    exit 1
fi

# Set env untuk Sail
export $(grep -v '^#' .env | xargs) 2>/dev/null
export WWWUSER=$(id -u)
export WWWGROUP=$(id -g)

# Jalankan semua container (Laravel + MySQL + phpMyAdmin)
echo "[*] Menjalankan container Docker..."
"$SAIL" up -d

echo ""
echo "[*] Menunggu MySQL siap..."
sleep 5

# Jalankan migrasi
echo "[*] Menjalankan migrasi database..."
"$SAIL" artisan migrate --force 2>&1 | tail -5

# Build aset jika belum ada
if [ ! -d "$PROJECT_DIR/public/build" ]; then
    echo "[*] Build aset frontend..."
    "$SAIL" npm install
    "$SAIL" npm run build
fi

echo ""
echo "======================================"
echo "  SIAP! Buka di browser:"
echo ""
echo "  Halaman Utama : http://localhost"
echo "  Admin Panel   : http://localhost/admin"
echo "  phpMyAdmin    : http://localhost:8081"
echo ""
echo "  Login phpMyAdmin:"
echo "  User     : sail"
echo "  Password : password"
echo ""
echo "  Untuk stop: ./stop.sh"
echo "======================================"
