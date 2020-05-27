<?php


namespace App\Ods\Elearning\Member\Entities;


class AnswerViewModel
{
    /**
     * @var String $description
     */
    public $description;

    public $choice;

    /**
     * AnswerViewModel constructor.
     * @param String $description
     * @param $choice
     */
    public function __construct(String $description, $choice)
    {
        $this->description = $description;
        $this->choice = $choice;
    }
}
