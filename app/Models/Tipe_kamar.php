<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe_kamar extends Model
{
    protected $table = 'tipe_kamar';
    protected $fillable = [
        'nama_tipe'
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
