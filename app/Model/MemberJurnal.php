<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberJurnal extends Model
{
    protected $table = 'member_jurnal';

    protected $fillable = [
        'member_id', 'judul',
        'tgl_terbit', 'file_name'
    ];
}
