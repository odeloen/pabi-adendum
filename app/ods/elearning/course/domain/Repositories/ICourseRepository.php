<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;

interface ICourseRepository
{
    public function insert($course);
    public function update($course);
    public function saveImage($course, $image);

    public function findByID($ID) : Course;
    public function findByLecturer($lecturerID);
}
