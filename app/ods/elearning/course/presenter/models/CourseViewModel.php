<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Common\Datetime\DateTimeToString;
use App\Ods\Elearning\Common\Modifier\ActionModifierViewTrait;
use App\Ods\Elearning\Course\Domain\Entities\Course;

class CourseViewModel
{
    use DateTimeToString;
    use ActionModifierViewTrait;

    public $id;
    public $name;
    public $description;
    public $image_path;

    public $lecturer;

    private $lock;

    public $created_at;
    public $updated_at;

    public $created_at_string;
    public $updated_at_string;

    public function __construct(Course $courseDomainModel)
    {
        $this->id = $courseDomainModel->getId();
        $this->name = $courseDomainModel->getName();
        $this->description = $courseDomainModel->getDescription();
        $this->image_path = $courseDomainModel->getImagePath();
        $this->lecturer = $courseDomainModel->getLecturer()->getFullname();

        $this->modifier = $courseDomainModel->getModifier();

        $this->lock = $courseDomainModel->getLock();

        $this->created_at = $courseDomainModel->getCreatedAt();
        $this->updated_at = $courseDomainModel->getUpdatedAt();

        $this->created_at_string = $this->convertTimeToString($this->created_at);
        $this->updated_at_string = $this->convertTimeToString($this->updated_at);
    }

    public function isLocked(){
        return $this->lock;
    }


}
