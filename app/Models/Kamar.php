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

    public function tipe() {
        return $this->belongsTo(Tipe_kamar::class);
    }
}
