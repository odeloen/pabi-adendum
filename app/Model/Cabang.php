<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'admin_cabang';

    protected $fillable = [
        'admin_pusat_id', 
        'name', 
        'kode_bandara',
        'description',
        'nama_bank', 
        'no_rek', 
        'pemilik_rek'
    ];
}
