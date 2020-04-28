<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MinatBidang extends Model
{
    protected $table = 'minat_bidang';

    protected $fillable = [
        'nama', 'kode'
    ];
}
