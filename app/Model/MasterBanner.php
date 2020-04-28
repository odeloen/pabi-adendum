<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterBanner extends Model
{
    protected $table = 'master_banner';

    protected $fillable = [
        'judul', 'isi','posisi_isi',
        'image_banner', 'image_banner_compress'
    ];
}
