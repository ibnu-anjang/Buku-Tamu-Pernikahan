<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;

// Guest Routes
Route::get('/', [GuestbookController::class, 'index'])->name('home');
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');

// Admin CRUD Routes (Password Protection can be added via middleware later)
Route::prefix('admin')->group(function () {
    Route::get('/', [GuestbookController::class, 'adminIndex'])->name('admin.index');
    Route::get('/{entry}/edit', [GuestbookController::class, 'edit'])->name('admin.edit');
    Route::put('/{entry}', [GuestbookController::class, 'update'])->name('admin.update');
    Route::delete('/{entry}', [GuestbookController::class, 'destroy'])->name('admin.destroy');
});
