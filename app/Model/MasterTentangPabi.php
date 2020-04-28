<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterTentangPabi extends Model
{
    protected $table = 'master_tentang_pabi';

    protected $fillable = [
        'judul', 'isi','posisi_isi',
        'image', 'image_compress'
    ];
}
