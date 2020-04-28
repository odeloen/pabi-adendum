<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'master_kegiatan';

    protected $fillable = [
        'master_jenis_kegiatan_id', 
        'nama_kegiatan', 
        'range_awal', 
        'range_akhir'
    ];
}
