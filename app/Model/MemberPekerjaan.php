<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberPekerjaan extends Model
{
    protected $table = 'member_pekerjaan';

    protected $fillable = [
        'member_id', 'nama_pekerjaan', 'tempat_pekerjaan'
    ];
}
