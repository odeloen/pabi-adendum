<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse as SubmittedCourseModel;
use App\Ods\Elearning\Admin\Entities\SubmittedCourse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SubmittedCourseRepository
{
    public function all() : Collection
    {
        $submittedCourses = SubmittedCourseModel::all();
        foreach ($submittedCourses as $submittedCourse) {
            $submittedCourse->created_at_string = $submittedCourse->getCreatedAt();
            $submittedCourse->updated_at_string = $submittedCourse->getUpdatedAt();
        }

        $courses = [];
        if ($submittedCourses != null){
            foreach ($submittedCourses as $submittedCourse) {
                $course = new SubmittedCourse($submittedCourse);
                $course->categories = $course->instance->categories;
                $course->lecturer = $course->instance->lecturer;
                $courses[] = $course;
            }
        }
        return collect($courses)->sortByDesc('instance.created_at');
    }

    public function find(string $id) : SubmittedCourse
    {
        $submittedCourse = SubmittedCourseModel::find($id);
        $submittedCourse->created_at_string = $submittedCourse->getCreatedAt();
        $submittedCourse->updated_at_string = $submittedCourse->getUpdatedAt();

        $course = new SubmittedCourse($submittedCourse);
        $course->categories = $course->instance->categories;
        return $course;
    }

    public function save(SubmittedCourse $course) : void
    {
        $course->getInstance()->save();

        $courseCategories = $course->categories;
        if ($courseCategories != null){
            foreach ($courseCategories as $category) {
                $category->save();
            }
        }

        return;
    }

    public function delete(SubmittedCourse $course) : void
    {
        $course->getInstance()->delete();
    }
}
