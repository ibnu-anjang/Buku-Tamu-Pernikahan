<?php

namespace App\Http\Controllers;

use App\Models\GuestbookEntry;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index()
    {
        $entries = GuestbookEntry::latest()->get();
        return view('welcome', compact('entries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        GuestbookEntry::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas doa dan ucapannya!');
    }

    public function adminIndex()
    {
        $entries = GuestbookEntry::latest()->get();
        return view('admin', compact('entries'));
    }

    public function edit(GuestbookEntry $entry)
    {
        return view('admin_edit', compact('entry'));
    }

    public function update(Request $request, GuestbookEntry $entry)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $entry->update($validated);

        return redirect()->route('admin.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    public function destroy(GuestbookEntry $entry)
    {
        $entry->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}
