<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;

Route::get('/', [GuestbookController::class, 'index'])->name('home');
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');
