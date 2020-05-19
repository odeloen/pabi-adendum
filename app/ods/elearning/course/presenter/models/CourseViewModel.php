<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Common\Datetime\DateTimeToString;
use App\Ods\Elearning\Course\Domain\Entities\Course;

class CourseViewModel
{
    use DateTimeToString;

    public $id;
    public $name;
    public $description;
    public $imagePath;

    public $lecturer;

    public $createdAt;
    public $updatedAt;

    public $createdAtString;
    public $updatedAtString;

    public function __construct(Course $courseDomainModel)
    {
        $this->id = $courseDomainModel->getId();
        $this->name = $courseDomainModel->getName();
        $this->description = $courseDomainModel->getDescription();
        $this->imagePath = $courseDomainModel->getImagePath();
        $this->lecturer = $courseDomainModel->getLecturer()->getFullname();
        $this->createdAt = $courseDomainModel->getCreatedAt();
        $this->updatedAt = $courseDomainModel->getUpdatedAt();

        $this->createdAtString = $this->convertTimeToString($this->createdAt);
        $this->updatedAtString = $this->convertTimeToString($this->updatedAt);
    }
}
