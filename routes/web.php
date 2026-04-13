<?php

use App\Http\Controllers\GuestbookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestbookController::class, 'index'])->name('home');
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');

Route::prefix('admin')->group(function () {
    Route::get('/', [GuestbookController::class, 'adminIndex'])->name('admin.index');
    Route::get('/{entry}/edit', [GuestbookController::class, 'edit'])->name('admin.edit');
    Route::put('/{entry}', [GuestbookController::class, 'update'])->name('admin.update');
    Route::delete('/{entry}', [GuestbookController::class, 'destroy'])->name('admin.destroy');
});
