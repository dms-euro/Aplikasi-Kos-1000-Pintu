<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $fillable = [
        'users_id',
        'nama',
        'kelamin',
        'tanggal_lahir',
        'pekerjaan',
        'kontak',
        'kontak_darurat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function komplain()
    {
        return $this->hasMany(Komplain::class, 'penghuni_id');
    }
}
