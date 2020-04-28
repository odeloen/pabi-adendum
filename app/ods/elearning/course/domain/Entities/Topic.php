<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


class Topic
{
    private $ID;

    private $name;
    private $description;

    private $materials;

    private $createdAt;
    private $updatedAt;

    /**
     * Topic constructor.
     * @param $name
     * @param $description
     * @param $createdAt
     * @param $updatedAt
     */
    public function __construct($ID, $name, $description)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
    }
}
