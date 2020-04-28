<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisEvent extends Model
{
	protected $table = 'master_jenis_event';

    protected $fillable = [
        'kode_jenis_event', 
        'nama_jenis_event', 
        'deskripsi'
    ];
}
