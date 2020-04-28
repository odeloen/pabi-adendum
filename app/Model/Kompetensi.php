<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    protected $table = 'kompetensi';

    protected $fillable = [
        'jenis_tindakan', 'tindakan', 
        'sudah', 'belum',
        'jumlah_kasus'
    ];
}
