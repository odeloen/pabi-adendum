<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'subject', 'body', 'refferer_id',
        'icon_notif', 'created_at'
    ];
}
