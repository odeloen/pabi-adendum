<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberAnak extends Model
{
    protected $table = 'member_anak';

    protected $fillable = [
        'member_id', 'nama_anak',
        'tempat_lahir_anak', 'gender',
        'tgl_lahir_anak'
    ];
}
