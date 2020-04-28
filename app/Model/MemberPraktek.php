<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberPraktek extends Model
{
    protected $table = 'member_praktek';

    protected $fillable = [
        'member_id', 'nama_tempat', 'no_sip',
        'tgl_sip'
    ];
}
