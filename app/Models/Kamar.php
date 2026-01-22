<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $fillable = [
        'tipe_kamar_id',
        'kode_kamar',
        'harga',
        'status',
    ];

    public function tipe_kamar()
    {
        return $this->belongsTo(Tipe_kamar::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'kamar_id');
    }
}
