<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MODEL: Berinteraksi dengan database.
 * Ini adalah bagian 'M' dalam MVC.
 */
class GuestbookEntry extends Model
{
    // Nama-nama kolom yang diizinkan untuk diisi (Mass Assignment)
    protected $fillable = [
        'name',
        'phone',
        'address',
        'message',
    ];
}
