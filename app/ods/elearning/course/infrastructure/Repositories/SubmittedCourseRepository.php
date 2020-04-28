<?php


namespace App\Ods\Elearning\Course\Infrastructure\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class SubmittedCourseRepository implements ICourseRepository
{
    public function insert($course)
    {
        // TODO: Implement insert() method.
    }

    public function update($course)
    {
        // TODO: Implement update() method.
    }

    public function saveImage($course, $image)
    {
        // Empty implementation of saveImage
    }

    public function findByID($ID): Course
    {
        // TODO: Implement findByID() method.
    }

    public function findByLecturer($lecturerID)
    {
        // TODO: Implement findByLecturer() method.
    }

    public function findByCourse($course)
    {
        // TODO: Implement findByCourse() method
    }
}
