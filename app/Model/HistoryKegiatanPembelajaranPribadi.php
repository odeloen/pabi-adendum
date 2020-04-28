<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoryKegiatanPembelajaranPribadi extends Model
{
	protected $table = 'history_kegiatan_pembelajaran_pribadi';

	protected $fillable = [
		'member_id',
		'master_kegiatan_id',
		'tanggal',
		'nama_kegiatan',
		'nama_jurnal_situsweb',
		'judul_artikel_topik',
		'tempat',
		'peran_serta',
		'penyelenggara',
		'tahun',
		'nilai_skp',
		'cabang_verif',
		'cabang_tgl',
		'cabang_ket',
		'rs_id',
		'rs_verif',
		'rs_tgl',
		'rs_ket'
	];
}
