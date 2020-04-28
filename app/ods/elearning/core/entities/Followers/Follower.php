<?php

namespace App\Ods\Elearning\Core\Entities\Followers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'course_followers';
}
