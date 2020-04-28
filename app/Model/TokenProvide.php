<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TokenProvide extends Model
{
    protected $table = 'token_provide';

    protected $fillable = [
        'user_id', 
        'token',
    ];
}
