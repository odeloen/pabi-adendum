<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\Course as OriginalCourse;
use App\Ods\Elearning\Lecturer\Entities\Course;
use App\Ods\Elearning\Lecturer\Entities\Lecturer;
use Illuminate\Support\Collection;

class OriginalCourseRepository
{
    public function create($lecturerID, $name, $description, $categories, $courseImage = null) : Course
    {
        $course = Course::create($lecturerID, $name, $description, $categories, $courseImage);
        return $course;
    }

    public function all() : Collection
    {
        $originalCourses = OriginalCourse::all();
        foreach ($originalCourses as $originalCourse) {
            $originalCourse->created_at_string = $originalCourse->getCreatedAt();
            $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();
        }

        $courses = [];
        foreach ($originalCourses as $originalCourse) {
            $course = new Course($originalCourse);
            $course->categories = $course->instance->categories;
            $courses[] = $course;
        }
        return collect($courses);
    }

    public function find(string $id) : Course
    {
        $originalCourse = OriginalCourse::find($id);
        $originalCourse->created_at_string = $originalCourse->getCreatedAt();
        $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();

        $course = new Course($originalCourse);
        $course->categories = $course->instance->categories;
        return $course;
    }

    public function findByLecturer(Lecturer $lecturer) : Collection
    {
        $originalCourses = $lecturer->courses;
        foreach ($originalCourses as $originalCourse) {
            $originalCourse->created_at_string = $originalCourse->getCreatedAt();
            $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();
        }

        $courses = [];
        if ($originalCourses != null){
            foreach ($originalCourses as $originalCourse) {
                $course = new Course($originalCourse);
                $course->categories = $course->instance->categories;
                $courses[] = $course;
            }
        }
        return collect($courses)->sortBy('instance.created_at');
    }

    public function findByMaterial($material) : Course
    {
        $originalCourse = $material->instance->topic->course;
        $originalCourse->created_at_string = $originalCourse->getCreatedAt();
        $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();

        $course = new Course($originalCourse);
        return $course;
    }

    public function findByTopic($topic) : Course
    {
        $originalCourse = $topic->instance->course;
        $originalCourse->created_at_string = $originalCourse->getCreatedAt();
        $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();

        $course = new Course($originalCourse);
        return $course;
    }

    public function save(Course $course) : void
    {
        $course->getInstance()->save();

        if (!empty($course->categories)){
            $courseCategories = $course->categories;
            if ($courseCategories != null){
                foreach ($courseCategories as $category) {
                    $category->save();
                }
            }
        }

        return;
    }

    public function delete(Course $course) : void
    {
        $course->getInstance()->delete();
    }
}
