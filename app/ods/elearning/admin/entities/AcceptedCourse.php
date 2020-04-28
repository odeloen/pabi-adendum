<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;
use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourseCategory;
use Ramsey\Uuid\Uuid;

class AcceptedCourse
{
    /** @var AcceptedCourseModel */
    public $instance;

    public function __construct(AcceptedCourseModel $course)
    {
        $this->instance = $course;
    }

    /** @return AcceptedCourseModel */
    public function getInstance(){
        return $this->instance;
    }

    public static function createFromSubmitted(SubmittedCourse $course) : AcceptedCourse
    {
        $originalCourse = $course->instance->origin;
        $acceptedCourse = $originalCourse->acceptedCourse;

        if ($acceptedCourse == null){
            $acceptedCourse =  new AcceptedCourseModel();
            $acceptedCourse->id = Uuid::uuid4()->toString();
        }

        $acceptedCourse->lecturer_id = $originalCourse->lecturer_id;
        $acceptedCourse->original_course_id = $course->instance->original_course_id;
        $acceptedCourse->name = $course->instance->name;
        $acceptedCourse->description = $course->instance->description;
        $acceptedCourse->image_path = $course->instance->image_path;

        $acceptedCourse = new AcceptedCourse($acceptedCourse);

        $categories = $course->instance->categories;
        if ($categories != null){
            $courseCategories = [];
            foreach ($categories as $category) {
                $courseCategory = new AcceptedCourseCategory();
                $courseCategory->course_id = $acceptedCourse->instance->id;
                $courseCategory->category_id = $category->id;
                $courseCategories[] = $courseCategory;
            }

            $acceptedCourse->categories = $courseCategories;
        }

        return $acceptedCourse;
    }
}
