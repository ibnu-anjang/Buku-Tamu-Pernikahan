#!/bin/bash

# ============================================
# Script Menghentikan Buku Tamu Pernikahan
# ============================================

PROJECT_DIR="$(cd "$(dirname "$0")" && pwd)"
SAIL="$PROJECT_DIR/vendor/bin/sail"

cd "$PROJECT_DIR"

echo "======================================"
echo "  Buku Tamu Pernikahan - STOP"
echo "======================================"

# Cek Docker berjalan
if ! docker info > /dev/null 2>&1; then
    echo "[!] Docker tidak berjalan, tidak ada yang perlu dihentikan."
    exit 0
fi

export WWWUSER=$(id -u)
export WWWGROUP=$(id -g)

echo "[*] Menghentikan semua container..."
"$SAIL" down

echo ""
echo "======================================"
echo "  Semua container berhasil dihentikan."
echo "  Jalankan lagi dengan: ./start.sh"
echo "======================================"
