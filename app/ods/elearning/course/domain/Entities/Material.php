<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


class Material
{
    private $ID;

    private $name;
    private $description;

    private $type;

    private $postContent;
    private $videoURL;
    private $filePath;

    private $createdAt;
    private $updatedAt;

    /**
     * Material constructor.
     * @param $ID
     * @param $name
     * @param $description
     */
    public function __construct($ID, $name, $description)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
    }


}
