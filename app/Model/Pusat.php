<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pusat extends Model
{
    protected $table = 'admin_pusat';

    protected $fillable = [
        'name', 
        'description',
        'nama_bank', 
        'no_rek', 
        'pemilik_rek'
    ];
}
