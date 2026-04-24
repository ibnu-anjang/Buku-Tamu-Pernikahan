#!/bin/bash

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJECT_DIR"

echo "======================================"
echo "  Buku Tamu Pernikahan - STOP"
echo "======================================"

if ! docker info > /dev/null 2>&1; then
    echo "[!] Docker tidak berjalan, tidak ada yang perlu dihentikan."
    read -rp "Tekan Enter untuk keluar..."
    exit 0
fi

echo "[*] Menghentikan semua container..."
docker compose down

echo ""
echo "======================================"
echo "  Semua container berhasil dihentikan."
echo "  Jalankan lagi dengan: ./start.sh"
echo "======================================"

read -rp "Tekan Enter untuk keluar..."
