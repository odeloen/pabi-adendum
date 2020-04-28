<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BorangFile extends Model
{
    protected $table = 'borang_file';

    protected $fillable = [
        'history_kegiatan_id', 'ranah_borang_id',
        'nama', 'keterangan', 'path_file'
    ];
}
