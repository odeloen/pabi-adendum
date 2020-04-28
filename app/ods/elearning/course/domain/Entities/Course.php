<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


class Course
{
    private $ID;
    private $name;
    private $description;
    private $imagePath;

    private $lecturer;
    private $submissions;

    private $modifierStatus;
    private $lockStatus;

    private $topics;
    private $students;

    /**
     * OriginalCourse constructor.
     * @param $ID
     * @param $name
     * @param $description
     */
    public function __construct($ID, $name, $description, $lecturer)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->lecturer = $lecturer;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLecturer()
    {
        return $this->lecturer;
    }



    public function update($name, $description) : void
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return mixed
     */
    public function getModifierStatus()
    {
        return $this->modifierStatus;
    }

    /**
     * @param mixed $modifierStatus
     */
    public function setModifierStatus($modifierStatus): void
    {
        $this->modifierStatus = $modifierStatus;
    }

    /**
     * @return mixed
     */
    public function getLockStatus()
    {
        return $this->lockStatus;
    }

    /**
     * @param mixed $lockStatus
     */
    public function setLockStatus($lockStatus): void
    {
        $this->lockStatus = $lockStatus;
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param mixed $topics
     */
    public function setTopics($topics): void
    {
        $this->topics = $topics;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $students
     */
    public function setStudents($students): void
    {
        $this->students = $students;
    }
}
