<?php


namespace App\ods\announcement\presenter\models;


use App\Ods\Announcement\Domain\Entities\Announcement;
use App\Ods\Common\Datetime\DateTimeToString;

class AnnouncementViewModel
{
    use DateTimeToString;

    public $id;
    public $title;
    public $description;
    public $imagePath;
    public $deletedAt;
    public $createdAt;
    public $updatedAt;

    public $createdAtString;
    public $updatedAtString;

    /**
     * AnnouncementViewModel constructor.
     */
    public function __construct(Announcement $announcement)
    {
        $this->id = $announcement->getId();
        $this->title = $announcement->getTitle();
        $this->description = $announcement->getDescription();
        $this->imagePath = $announcement->getImagePath();
        $this->deletedAt = $announcement->getDeletedAt();
        $this->createdAt = $announcement->getCreatedAt();
        $this->updatedAt = $announcement->getUpdatedAt();

        $this->createdAtString = $this->convertTimeToString($announcement->getCreatedAt());
        $this->updatedAtString = $this->convertTimeToString($announcement->getUpdatedAt());
    }
}
