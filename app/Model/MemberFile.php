<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberFile extends Model
{
    protected $table = 'member_file';

    protected $fillable = [
	    'member_id', 'file_name',
	    'keterangan', 'jenis_file', 'kode_unik'
    ];
}
