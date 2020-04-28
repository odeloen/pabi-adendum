<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Core\Entities\OdsUser;
use App\Ods\Elearning\Core\Config\Naming;

class Lecturer extends OdsUser
{
    protected $connection = 'odssql';
    protected $table = 'users';

    public function courses(){
        return $this->hasMany(Naming::getNamespace().'Entities\Courses\Course', 'lecturer_id', 'id');
    }
}
