<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    protected $table = 'master_jenis_kegiatan';

    protected $fillable = [
        'master_ranah_borang_id', 
        'nama_jenis_kegiatan', 
        'kode_jenis_kegiatan'
    ];
}
