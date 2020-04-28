<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventHarga extends Model
{
    protected $table = 'event_harga';

    protected $fillable = [
        'harga', 'kategori', 'event_id', 'kuota_peserta', 'status_harga'
    ];
}
