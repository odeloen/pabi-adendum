<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'gelar',
        'tempat_lahir', 'tempat_lahir', 'tempat_lahir',
        'gender', 'image_thumb', 'cabang_id', 'card_no', 'valid_until_card_no',
        'finacs', 'valid_until_finacs', 'resertifikasi',
        'valid_until_resertifikasi', 'no_pabi_sejahtera', 
        'no_pabi_sejahtera', 'minat_bidang', 'tempat_kerja',
        'jabatan', 'alamat_rumah', 'kota', 'alamat_kantor',
        'no_telp', 'hobi', 'no_str', 'sjk_tahun_no_str', 'keterangan'
    ];
}
