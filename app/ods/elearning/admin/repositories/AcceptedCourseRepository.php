<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;
use App\Ods\Elearning\Admin\Entities\AcceptedCourse;
use App\Ods\Elearning\Admin\Entities\SubmittedCourse;

class AcceptedCourseRepository
{
    public function create(SubmittedCourse $submittedTopic) : AcceptedCourse
    {
        $course = AcceptedCourse::createFromSubmitted($submittedTopic);
        return $course;
    }

    public function find(string $id) : AcceptedCourse
    {
        $course = AcceptedCourseModel::find($id);
        $course = new AcceptedCourse($course);
        $course->categories = $course->instance->categories;
        return $course;
    }

    public function save(AcceptedCourse $course) : void
    {
        $course->getInstance()->save();
    }

    public function delete(AcceptedCourse $course) : void
    {
        $course->getInstance()->delete();
    }
}
