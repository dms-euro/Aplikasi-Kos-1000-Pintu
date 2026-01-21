<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'penghuni_id',
        'kamar_id',
        'tanggal_masuk',
        'paket_bulanan',
        'status_pemesanan',
    ];
}
