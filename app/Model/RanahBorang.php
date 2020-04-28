<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RanahBorang extends Model
{
    protected $table = 'master_ranah_borang';

    protected $fillable = [
        'nama_ranah', 
        'skp_minimum', 
        'deskripsi'
    ];
}
