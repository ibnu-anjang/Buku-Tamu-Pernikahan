<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookEntry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'message',
    ];
}
