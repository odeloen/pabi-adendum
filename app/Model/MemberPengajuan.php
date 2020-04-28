<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberPengajuan extends Model
{
    protected $table = 'member_pengajuan';

    protected $fillable = [
        'member_id', 'tanggal_masuk', 'dari_cabang',
        'ke_cabang', 'cabang_lama_verif', 'cabang_lama_tgl',
        'cabang_lama_ket', 'cabang_baru_verif', 'cabang_baru_tgl',
        'cabang_baru_ket', 'pusat_verif', 'pusat_tgl', 'pusat_ket', 'kode_unik'
    ];
}
