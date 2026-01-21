<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
        'pemesanan_id',
        'bulan',
        'jumlah',
        'status',
    ];
}
