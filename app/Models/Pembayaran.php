<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'tanggal_bayar',
        'jumlah',
        'status',
        'bukti_bayar',
        'petugas_id',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class);
    }
}
