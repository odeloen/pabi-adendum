<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberMinatBidang extends Model
{
    protected $table = 'member_minat_bidang';

    protected $fillable = [
        'member_id',
        'nama', 'jenis_minat',
    ];
}
