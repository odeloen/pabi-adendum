<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Entities\Courses\Course as OriginalCourse;
use App\Ods\Elearning\Core\Entities\Courses\CourseCategory;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse as SubmittedCourseModel;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourseCategory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Course
{
    /** @var OriginalCourse */
    public $instance;

    public function __construct(OriginalCourse $course)
    {
        $this->instance = $course;
    }

    /** @return OriginalCourse */
    public function getInstance(){
        return $this->instance;
    }

    public static function create($lecturerID, $name, $description, $categories, $image){
        $course = new OriginalCourse();
        $courseID = Uuid::uuid4()->toString();
        $course->id = $courseID;
        $course->name = $name;
        $course->description = $description;
        $course->lecturer_id = $lecturerID;

        $course->setCreated();

        $course = new Course($course);

        if ($categories != null){
            $courseCategories = [];
            foreach ($categories as $category) {
                $courseCategory = new CourseCategory();
                $courseCategory->course_id = $courseID;
                $courseCategory->category_id = $category;
                $courseCategories[] = $courseCategory;
            }

            $course->categories = $courseCategories;
        }

        if ($image != null){
            $imageDirectory = 'Ods/elearning/courses/images/';
            $courseImageFilePath = $image->store('public/'.$imageDirectory);
            $tempArray = explode('/', $courseImageFilePath);

            $fileName = end($tempArray);
            $filePath = $imageDirectory.$fileName;
            $course->instance->image_path = $filePath;
        }

        return $course;
    }

    public function update($name, $description, $categoryIDs, $image){
        $this->instance->name = $name;
        $this->instance->description = $description;

        if ($categoryIDs != null){
            $categories = $this->instance->categories;
            // Purge course categories
            foreach ($categories as $category) {
                $category->delete();
            }

            $courseCategories = [];
            foreach ($categoryIDs as $categoryID) {
                $courseCategory = new CourseCategory();
                $courseCategory->course_id = $this->instance->id;
                $courseCategory->category_id = $categoryID;
                $courseCategories[] = $courseCategory;
            }

            $this->categories = $courseCategories;
        }

        if ($image != null){
            if ($this->instance->image_path != null && file_exists(storage_path('app/public/'.$this->instance->image_path))){
                unlink(storage_path('app/public/'.$this->instance->image_path));
            }

            $imageDirectory = 'Ods/elearning/courses/images/';
            $courseImageFilePath = $image->store('public/'.$imageDirectory);
            $tempArray = explode('/', $courseImageFilePath);

            $fileName = end($tempArray);
            $filePath = $imageDirectory.$fileName;
            $this->instance->image_path = $filePath;
        }

        $this->instance->setUpdated();
    }

    public function delete(){
        if ($this->instance->isCreated()) {
            return true;
        } else  {
            $this->instance->setDeleted();
            return false;
        }
    }

    public function setLock(){
        $this->instance->lock = true;
    }

    public function releaseLock(){
        $this->instance->lock = false;
    }

    public function isLocked(){
        return $this->instance->lock;
    }

    public function makeSubmitCopy(){
        $submission = new SubmittedCourseModel();
        $submission->id = Uuid::uuid4()->toString();
        $submission->lecturer_id = $this->instance->lecturer_id;
        $submission->original_course_id = $this->instance->id;
        $submission->image_path = $this->instance->image_path;
        $submission->unique_code = Str::random(6);
        $submission->name = $this->instance->name;
        $submission->description = $this->instance->description;
        $submission->modifier = $this->instance->getActionID();

        $submission = new SubmittedCourse($submission);

        $categories = $this->instance->categories;
        if ($categories != null){
            $courseCategories = [];
            foreach ($categories as $category) {
                $courseCategory = new SubmittedCourseCategory();
                $courseCategory->submitted_course_id = $submission->instance->id;
                $courseCategory->category_id = $category->id;
                $courseCategories[] = $courseCategory;
            }

            $submission->categories = $courseCategories;
        }

        return $submission;
    }
}
