<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengajuanHistory extends Model
{
    protected $table = 'members_history_pengajuan';

    protected $fillable = [
        'user_id', 'member_id', 'firstname', 'lastname', 'nickname', 'gelar',
        'tempat_lahir', 'tempat_lahir', 'tempat_lahir',
        'gender', 'image_thumb', 'cabang_id', 'card_no', 'valid_until_card_no',
        'finacs', 'valid_until_finacs', 'resertifikasi',
        'valid_until_resertifikasi', 'no_pabi_sejahtera', 
        'cabang_verif', 'cabang_tgl', 'cabang_ket',
        'pusat_verif', 'pusat_tgl', 'pusat_ket', 
        'no_pabi_sejahtera', 'tempat_kerja', 'tgl_pabi_sejahtera',
        'jabatan', 'alamat_rumah', 'kota', 'alamat_kantor',
        'no_telp', 'hobi', 'no_str', 'sjk_tahun_no_str', 'keterangan'
    ];
}
