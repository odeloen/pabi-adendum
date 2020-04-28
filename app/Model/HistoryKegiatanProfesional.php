<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoryKegiatanProfesional extends Model
{
    protected $table = 'history_kegiatan_profesional';

    protected $fillable = [
        'member_id',
		'master_kegiatan_id', 
        'tanggal', 
        'kode_kegiatan', 
        'jenis_kegiatan_diagnostik', 
        'peran_serta_diagnostik', 
        'nama_tindakan_operasi', 
        'jenis_operasi', 
        'jenis_kasus_bedah', 
        'jenis_tindakan_bedah', 
        'jenis_kasus_rujukan', 
        'tujuan_rujukan', 
        'nilai_skp', 
        'tahun', 
		'cabang_verif', 
		'cabang_tgl', 
		'cabang_ket',
        'lokasi_embed', 
        'lokasi_koordinat_x', 
        'lokasi_koordinat_y', 
        'lokasi_alamat',
        'prov_id', 
        'kota_id', 
        'kec_id', 
        'no_rekam_medik',
        'rs_id',
        'rs_verif',
        'rs_tgl',
        'rs_ket'
    ];
}
