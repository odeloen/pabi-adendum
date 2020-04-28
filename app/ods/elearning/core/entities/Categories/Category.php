<?php

namespace App\Ods\Elearning\Core\Entities\Categories;

use App\Ods\Elearning\Core\Config\Naming;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'odssql';
    protected $table = 'categories';

    public function courses(){
        return $this->belongsToMany(Naming::getNamespace().'Entities\Courses\Course', 'course_categories', 'category_id', 'course_id');
    }

    public function acceptedCourses(){
        return $this->belongsToMany(Naming::getNamespace().'Entities\Courses\AcceptedCourse', 'accepted_course_categories', 'category_id', 'accepted_course_id');
    }
}
