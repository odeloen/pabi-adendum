<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $fillable = [
        'user_id', 'name', 'tempat_lahir',
        'tgl_lahir', 'pekerjaan', 'npa_id', 'tmt'
    ];
}
