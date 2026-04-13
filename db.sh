#!/bin/bash

# ============================================
# Script Buka phpMyAdmin / Database Viewer
# ============================================

echo "======================================"
echo "  Buku Tamu - Database"
echo "======================================"
echo ""
echo "  Buka phpMyAdmin di browser:"
echo "  URL      : http://localhost:8081"
echo "  User     : sail"
echo "  Password : password"
echo ""

# Coba buka otomatis di browser
if command -v xdg-open &> /dev/null; then
    echo "[*] Membuka browser..."
    xdg-open "http://localhost:8081"
elif command -v open &> /dev/null; then
    echo "[*] Membuka browser..."
    open "http://localhost:8081"
else
    echo "  Buka manual di browser: http://localhost:8081"
fi

echo "======================================"
