<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


use App\Ods\Elearning\Course\Domain\Entities\Course;

class CreateCourseUsecaseRequest
{
    private $image;

    /**
     * @var Course
     */
    private $course;

    /**
     * CreateCourseUsecaseRequest constructor.
     * @param $name
     * @param $description
     * @param $imageBlob
     */
    public function __construct($lecturer, $name, $description, $imageBlob)
    {

        $this->course = new Course(null, $name, $description, $lecturer);
        $this->image = $imageBlob;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}
