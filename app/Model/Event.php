<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'nama_event', 'jenis_event', 'admin_cabang_id', 'max_event', 'foto_event_compress',
        'admin_pusat_id', 'tgl_event', 'foto_event', 'deskripsi', 'status_event',
        'lokasi_embed', 'lokasi_koordinat_x', 'lokasi_koordinat_y', 'lokasi_alamat',
        'prov_id', 'kota_id', 'kec_id', 'barcode_image', 'sisa_max_kuota', 
        'jam_mulai', 'jam_selesai', 'numpang_simposium_event_id', 'jenis_event_id', 'nama_bank', 'no_rek', 'pemilik_rek'
    ];
}
