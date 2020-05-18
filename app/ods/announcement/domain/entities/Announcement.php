<?php


namespace App\Ods\Announcement\Domain\Entities;

use App\Ods\Common\Entities\BaseEntity;

class Announcement extends BaseEntity
{
    private $title;
    private $description;
    private $imagePath;

    /**
     * Announcement constructor.
     */
    public function __construct(){

    }

    /**
     * Announcement factory method.
     */
    public static function create(
        $id,
        $title,
        $description,
        $imagePath,
        $deletedAt,
        String $createdAt,
        String $updatedAt
    ){
        $announcement = new Announcement();
        $announcement->id = $id;
        $announcement->title = $title;
        $announcement->description = $description;
        $announcement->imagePath = $imagePath;
        $announcement->deletedAt = $deletedAt;
        $announcement->createdAt = $createdAt;
        $announcement->updatedAt = $updatedAt;

        return $announcement;
    }

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param String $imagePath
     */
    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }
}
