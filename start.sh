#!/bin/bash
set -euo pipefail

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJECT_DIR"

# Tangkap error dan tahan terminal sebelum close
trap 'echo ""; echo "[X] Script berhenti karena error di baris $LINENO."; read -rp "Tekan Enter untuk keluar..."' ERR

echo "======================================"
echo "  Buku Tamu Pernikahan - MULAI"
echo "======================================"

if ! docker info > /dev/null 2>&1; then
    echo "[X] Docker tidak berjalan!"
    echo "    Buka Docker Desktop terlebih dahulu, lalu coba lagi."
    read -rp "Tekan Enter untuk keluar..."
    exit 1
fi

echo "[*] Menjalankan container Docker..."
docker compose up -d --build

echo ""
echo "[*] Menunggu database siap..."
MAX_WAIT=60
ELAPSED=0
DB_ROOT_PASS=$(grep -E "^DB_ROOT_PASS=" .env | cut -d= -f2)
until docker compose exec -T db mariadb -u root -p"${DB_ROOT_PASS}" \
      -e "SELECT 1;" &>/dev/null; do
    sleep 2
    ELAPSED=$((ELAPSED + 2))
    if [[ $ELAPSED -ge $MAX_WAIT ]]; then
        echo "[X] Database tidak merespons. Cek: docker compose logs db"
        read -rp "Tekan Enter untuk keluar..."
        exit 1
    fi
    echo -n "."
done
echo ""
echo "[*] Database siap."

echo "[*] Menjalankan migrasi database..."
docker compose exec app php artisan migrate --force 2>&1 | tail -5

if [ ! -d "$PROJECT_DIR/public/build" ]; then
    echo "[*] Build aset frontend..."
    npm install
    npm run build
fi

# Perbaiki permission storage
docker compose exec app bash -c \
    "chmod -R 775 storage bootstrap/cache && \
     chown -R www-data:www-data storage bootstrap/cache" 2>/dev/null || true

echo ""
echo "======================================"
echo "  SIAP! Buka di browser:"
echo ""
echo "  Halaman Utama : http://localhost:8080"
echo "  Admin Panel   : http://localhost:8080/admin"
echo "  phpMyAdmin    : http://localhost:8081"
echo ""
echo "  Login phpMyAdmin:"
echo "  User     : root"
echo "  Password : rootsecret"
echo ""
echo "  Untuk stop: ./stop.sh"
echo "======================================"

read -rp "Tekan Enter untuk keluar..."
