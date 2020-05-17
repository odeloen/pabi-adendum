<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


use App\Ods\Common\Entities\BaseEntity;
use App\Ods\Elearning\Common\Modifier\ActionModifierDomainTrait;

class Course extends BaseEntity
{
    use ActionModifierDomainTrait;

    /**
     * @var String $name
     */
    private $name;

    /**
     * @var String $description
     */
    private $description;

    /**
     * @var String $imagePath
     */
    private $imagePath;

    /**
     * @var Lecturer $lecturer
     */
    private $lecturer;

    /**
     * Course constructor.
     */
    public function __construct(){
    }

    /**
     * Course factory method.
     */
    public static function createFromExisting(
        String $id,
        Lecturer $lecturer,
        String $name,
        String $description,
        String $imagePath,
        int $modifier = null
    ){
        $course = new Course();
        $course->id = $id;
        $course->lecturer = $lecturer;
        $course->name = $name;
        $course->description = $description;
        $course->imagePath = $imagePath;
        $course->modifier = $modifier;

        return $course;
    }

    public static function createNewCourse(
        Lecturer $lecturer,
        String $name,
        String $description
    ){
        $course = new Course();
        $course->lecturer = $lecturer;
        $course->name = $name;
        $course->description = $description;
        $course->markCreated();;

        return $course;
    }

    public function update(
        String $name,
        String $description
    ){
        $this->name = $name;
        $this->description = $description;

        $this->markUpdated();
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @return String
     */
    public function getImagePath(): String
    {
        return $this->imagePath;
    }

    /**
     * @param String $imagePath
     */
    public function setImagePath(String $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return Lecturer
     */
    public function getLecturer(): Lecturer
    {
        return $this->lecturer;
    }
}