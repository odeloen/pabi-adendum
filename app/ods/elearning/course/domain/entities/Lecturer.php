<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


class Lecturer
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var String $fullname
     */
    private $fullname;

    /**
     * Lecturer constructor.
     * @param int $id
     * @param String $fullname
     */
    public function __construct(int $id, String $fullname)
    {
        $this->id = $id;
        $this->fullname = $fullname;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getFullname()
    {
        return $this->fullname;
    }
}
