<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberPasangan extends Model
{
    protected $table = 'member_pasangan';

    protected $fillable = [
        'member_id', 'nama_pasangan', 'gender',
        'tempat_lahir_pasangan', 'tgl_lahir_pasangan',
        'alamat_rumah_pasangan', 'kota_pasangan',
        'pekerjaan_pasangan'
    ];
}
