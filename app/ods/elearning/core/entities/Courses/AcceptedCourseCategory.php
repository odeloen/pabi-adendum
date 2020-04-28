<?php

namespace App\Ods\Elearning\Core\Entities\Courses;

use App\Ods\Elearning\Core\Config\Naming;
use Illuminate\Database\Eloquent\Model;

class AcceptedCourseCategory extends Model
{
    protected $connection = 'odssql';
    
    public function course(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\AcceptedCourse');
    }

    public function category(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Categories\Category');
    }
}
