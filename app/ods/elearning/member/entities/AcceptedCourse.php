<?php

namespace App\Ods\Elearning\Member\Entities;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;

class AcceptedCourse
{
    /** @var AcceptedCourseModel */
    public $instance;

    public function __construct(AcceptedCourseModel $course)
    {
        $this->instance = $course;
    }
}
