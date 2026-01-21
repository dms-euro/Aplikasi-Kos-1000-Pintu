<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    protected $table = 'komplain';

    protected $fillable = [
        'penghuni_id',
        'deskripsi',
        'status',
    ];
}
