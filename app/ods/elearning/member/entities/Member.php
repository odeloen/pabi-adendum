<?php

namespace App\Ods\Elearning\Member\Entities;

use App\Ods\Core\Entities\OdsUser;
use App\Ods\Elearning\Core\Entities\Followers\Follower;

class Member extends OdsUser
{
    protected $connection = 'odssql';
    protected $table = 'users';

    public function followedCourses(){
        return $this->belongsToMany('App\Ods\Elearning\Core\Entities\Courses\Course',
                                    'course_followers',
                                    'member_id',
                                    'course_id',
                                    'id',
                                    'id')->whereNull('course_followers.deleted_at');
    }
}
