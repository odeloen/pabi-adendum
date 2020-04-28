<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'nickname', 'gelar',
        'tempat_lahir', 'tempat_lahir', 'tgl_lahir',
        'gender', 'image_thumb', 'cabang_id', 'card_no', 'valid_until_card_no', 'card_no_issue',
        'finacs', 'valid_until_finacs', 'resertifikasi', 'image_thumb_compress',
        'valid_until_resertifikasi', 'no_pabi_sejahtera',
        'cabang_verif', 'cabang_tgl', 'cabang_ket',
        'pusat_verif', 'pusat_tgl', 'pusat_ket', 
        'no_telp_kantor', 'no_skk_bedah', 'tgl_skk_bedah', 'no_sip_terakhir',
        'tgl_sip_mulai', 'tgl_sip_selesai', 'no_hp',
        'no_pabi_sejahtera', 'tempat_kerja', 'tgl_pabi_sejahtera',
        'jabatan', 'alamat_rumah', 'kota', 'alamat_kantor',
        'no_telp', 'hobi', 'no_str', 'sjk_tahun_no_str', 'keterangan',
        'bank_nama', 'bank_pemilik', 'bank_no_rekening', 'email',
        'is_non_aktif', 'alasan_non_aktif'
    ];
}
