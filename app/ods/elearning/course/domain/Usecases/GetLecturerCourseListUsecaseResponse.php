<?php


namespace App\ods\elearning\course\Domain\Usecases;


class GetLecturerCourseListUsecaseResponse
{
    private $courses;

    /**
     * GetLecturerCourseListUsecaseResponse constructor.
     * @param $courses
     */
    public function __construct($courses)
    {
        $this->courses = $courses;
    }


    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }


}
