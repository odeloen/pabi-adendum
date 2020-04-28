<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberPendidikan extends Model
{
    protected $table = 'member_pendidikan';

    protected $fillable = [
        'member_id', 'jenjang_pendidikan',
        'jurusan', 'tgl_lulus'
    ];
}
