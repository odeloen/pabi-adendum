<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{
    protected $table = 'borang';

    protected $fillable = [
        'member_id', 
        'master_ranah_borang_id', 
        'tahun_periode_awal', 
        'tahun_periode_saat_ini', 
        'tahun_periode_akhir', 
        'nama', 
        'min_poin'
    ];
}
