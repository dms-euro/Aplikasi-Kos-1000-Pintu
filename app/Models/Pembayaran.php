<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'tagihan_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_pembayaran',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
