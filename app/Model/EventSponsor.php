<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventSponsor extends Model
{
    protected $table = 'event_sponsor';

    protected $fillable = [
        'nama', 'kategori', 'event_id', 'logo_image', 'deskripsi'
    ];
}
