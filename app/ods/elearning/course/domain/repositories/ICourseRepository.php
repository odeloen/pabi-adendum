<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;

interface ICourseRepository
{
    /**
     * @return ITopicRepository
     */
    public function getTopicRepository();

    /**
     * @return IMaterialRepository
     */
    public function getMaterialRepository();

    /**
     * @return ILecturerRepository
     */
    public function getLecturerRepository();

    /**
     * @param Lecturer $lecturer
     * @return Course[]
     */
    public function findByLecturer(Lecturer $lecturer);

    /**
     * @param String $courseID
     * @return Course
     */
    public function findByID(String $courseID);

    public function insert(Course $course, $image = null);
    public function update(Course $course, $image = null);
    public function delete(Course $course);
}
