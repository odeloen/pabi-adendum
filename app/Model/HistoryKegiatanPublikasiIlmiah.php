<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoryKegiatanPublikasiIlmiah extends Model
{
    protected $table = 'history_kegiatan_publikasi_ilmiah';

    protected $fillable = [
        'member_id',
		'master_kegiatan_id', 
        'tanggal', 
        'nama_kegiatan', 
        'judul_artikel', 
        'nama_buku_jurnal', 
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
