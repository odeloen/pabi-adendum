<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Admin\Entities\OriginalCourse;
use App\Ods\Elearning\Admin\Entities\SubmittedCourse;
use App\Ods\Elearning\Core\Entities\Courses\Course as OriginalCourseModel;

class OriginalCourseRepository
{
    public function find(string $id) : OriginalCourse
    {
        $course = OriginalCourseModel::find($id);
        $course = new OriginalCourse($course);
        $course->categories = $course->instance->categories;
        return $course;
    }

    public function findBySubmission(SubmittedCourse $submittedCourse) : OriginalCourse
    {
        $originalCourse = $submittedCourse->instance->origin;
        return new OriginalCourse($originalCourse);
    }

    public function save(OriginalCourse $course) : void
    {
        $course->getInstance()->save();

        return;
    }

    public function delete(OriginalCourse $course) : void
    {
        $course->getInstance()->delete();
    }
}
