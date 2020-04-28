<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


class UpdateCourseUsecaseRequest
{
    private $courseID;

    private $name;
    private $description;
    private $image;

    /**
     * UpdateCourseUsecaseRequest constructor.
     * @param $courseID
     * @param $name
     * @param $description
     * @param $image
     */
    public function __construct($courseID, $name, $description, $image)
    {
        $this->courseID = $courseID;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }


    /**
     * @return mixed
     */
    public function getCourseID()
    {
        return $this->courseID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}
