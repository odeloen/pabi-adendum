<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'buku_tamu';

    protected $fillable = [
        'event_id', 'event_harga_id', 'member_id', 'status_hadir', 
        'status_acc', 'status_daftar', 'tgl_member_daftar', 
        'tgl_admin_acc', 'status_bayar', 'tgl_bayar', 'expired_bayar'
	    , 'bukti_bayar' , 'status_pengajuan_bayar', 'tgl_pengajuan_bayar',
        'kode_unik', 'nominal_bayar', 'nominal_terbayar', 'nama_bank'
	    , 'nama_pemilik_rekening', 'nomor_rekening'
	    , 'tgl_hadir_param'
	    , 'tgl_hadir_sistem'
    ];
}
