<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberUjian extends Model
{
    protected $table = 'member_ujian';

    protected $fillable = [
        'member_id', 'nama_ujian', 'tgl_lulus',
        'valid_until', 'jenis'
    ];
}
