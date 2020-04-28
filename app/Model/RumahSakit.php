<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    protected $table = 'rumah_sakit';

    protected $fillable = [
        'nama', 'telpon', 'alamat', 'img_logo',
        'id_provinsi', 'id_kabupaten_kota', 'user_id'
    ];
}
