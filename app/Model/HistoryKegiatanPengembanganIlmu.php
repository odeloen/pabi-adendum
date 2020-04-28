<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoryKegiatanPengembanganIlmu extends Model
{
    protected $table = 'history_kegiatan_pengembangan_ilmu';

    protected $fillable = [
        'member_id',
		'master_kegiatan_id', 
        'tanggal', 
        'nama_kegiatan', 
        'judul_penelitian', 
        'dipublikasikan_diserahkan_pada', 
        'judul_matkul', 
        'institusi', 
        'peran_serta', 
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
