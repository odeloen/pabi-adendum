<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Entities\Courses\Course as OriginalCourse;
use App\Ods\Elearning\Core\Entities\Courses\CourseCategory;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse as SubmittedCourseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class SubmittedCourse
{
    /** @var SubmittedCourseModel */
    public $instance;

    public function __construct(SubmittedCourseModel $course)
    {
        $this->instance = $course;
    }

    /** @return SubmittedCourseModel */
    public function getInstance(){
        return $this->instance;
    }

    public function setSummary(string $summary){
        $this->instance->summary = $summary;
    }
}
