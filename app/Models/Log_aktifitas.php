<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_aktifitas extends Model
{
    protected $table = 'log_aktifitas';

    protected $fillable = [
        'users_id',
        'aksi',
        'nama_table',
        'id_data',
    ];
}
