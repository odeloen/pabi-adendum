<?php

namespace App\Ods\Elearning\Core\Entities\Courses;

use App\Ods\Elearning\Core\Config\Naming;
use Illuminate\Database\Eloquent\Model;
use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Topics\Topic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Ods\Elearning\Core\Entities\Courses
 * @mixin \Eloquent
 */
class Course extends Model
{
    use SoftDeletes;
    use ActionModifier;

    protected $connection = 'odssql';

    protected $table = 'courses';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    /** @return SubmittedCourse */
    public function submittedCourses(){
        return $this->hasMany(Naming::getNamespace().'Entities\Courses\SubmittedCourse', 'original_course_id', 'id');
    }

    /** @return Topic */
    public function topics(){
        return $this->hasMany(Naming::getNamespace().'Entities\Topics\Topic', 'course_id', 'id');
    }

    /** @return AcceptedCourse */
    public function acceptedCourse(){
        return $this->hasOne(Naming::getNamespace().'Entities\Courses\AcceptedCourse', 'original_course_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(Naming::getNamespace().'Entities\Categories\Category', 'course_categories', 'course_id', 'category_id', 'id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
