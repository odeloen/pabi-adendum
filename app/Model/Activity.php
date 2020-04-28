<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [
        'user_id', 
        'role_id', 
        'token_expired_at', 
        'status_online'
    ];
}
