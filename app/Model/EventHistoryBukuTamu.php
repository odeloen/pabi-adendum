<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventHistoryBukuTamu extends Model
{
    protected $table = 'event_history_buku_tamu';

    protected $fillable = [
        'buku_tamu_id', 'event_id',
        'member_id', 'notes', 'status'
    ];
}
