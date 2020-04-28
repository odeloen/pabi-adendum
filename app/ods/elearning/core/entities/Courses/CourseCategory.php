<?php

namespace App\Ods\Elearning\Core\Entities\Courses;

use App\Ods\Elearning\Core\Config\Naming;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $connection = 'odssql';
    protected $table = 'course_categories';

    public function course(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\Course');
    }

    public function category(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Categories\Category');
    }
}
