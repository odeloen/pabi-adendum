<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoryKegiatanPengabdianMasyarakat extends Model
{
    protected $table = 'history_kegiatan_pengabdian_masyarakat';

    protected $fillable = [
        'member_id',
		'master_kegiatan_id', 
        'nama_kegiatan', 
        'tanggal_mulai', 
        'jenis_kegiatan', 
        'tanggal_selesai', 
        'nama_organisasi_event', 
        'jabatan', 
        'nilai_skp', 
        'tahun', 
		'cabang_verif', 
		'cabang_tgl', 
		'cabang_ket',
        'rs_id',
        'rs_verif',
        'rs_tgl',
        'rs_ket'
    ];
}
