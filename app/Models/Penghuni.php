<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $tabel = 'penghuni';
    protected $fillable = [
        'users_id',
        'nik',
        'telepon',
    ];
}
