<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse as SubmittedCourseModel;
use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic;
use App\Ods\Elearning\Lecturer\Entities\Course;
use App\Ods\Elearning\Lecturer\Entities\SubmittedCourse;
use Illuminate\Support\Collection;

class SubmittedCourseRepository
{
    public function find(string $id) : SubmittedCourse
    {
        $submittedCourse = SubmittedCourseModel::withTrashed()->where('id', $id)->first();
        $submittedCourse->created_at_string = $submittedCourse->getCreatedAt();
        $submittedCourse->updated_at_string = $submittedCourse->getUpdatedAt();

        $course = new SubmittedCourse($submittedCourse);
        $course->categories = $course->instance->categories;
        return $course;
    }

    public function findByCourse(Course $course){
        $submittedCourses = SubmittedCourseModel::withTrashed()->where('original_course_id', $course->instance->id)->get();
        foreach ($submittedCourses as $submittedCourse) {
            $submittedCourse->created_at_string = $submittedCourse->getCreatedAt();
            $submittedCourse->updated_at_string = $submittedCourse->getUpdatedAt();
        }

        $courses = [];
        if ($submittedCourses != null){
            foreach ($submittedCourses as $submittedCourse) {
                $course = new SubmittedCourse($submittedCourse);
                $course->categories = $course->instance->categories;
                $courses[] = $course;
            }
        }
        return collect($courses)->sortByDesc('instance.created_at');
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
}
