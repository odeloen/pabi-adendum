<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterBerita extends Model
{
    protected $table = 'master_berita';

    protected $fillable = [
        'judul', 'isi', 'is_top',
        'image_berita', 'image_berita_compress'
    ];
}
