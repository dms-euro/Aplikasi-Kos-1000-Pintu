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
        'tanggal_keluar',
        'durasi_bulanan',
        'total',
        'status',
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'sewa_id');
    }
}
