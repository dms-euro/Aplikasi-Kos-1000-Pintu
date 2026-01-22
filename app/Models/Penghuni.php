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

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'penghuni_id');
    }

    

    public function komplain()
    {
        return $this->hasMany(Komplain::class, 'penghuni_id');
    }
}
