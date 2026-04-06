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
    // Method untuk menampilkan halaman utama dan daftar pesan (READ)
    public function index()
    {
        $entries = GuestbookEntry::latest()->get();
        return view('welcome', compact('entries')); // Mengirim data ke VIEW
    }

    // Method untuk menyimpan ucapan baru (CREATE)
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Menyimpan data ke database melalui MODEL
        GuestbookEntry::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas doa dan ucapannya! ❤️');
    }
}
