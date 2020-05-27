<?php


namespace App\Ods\Elearning\Member\Entities;


class QuestionViewModel
{
    /**
     * @var int $no
     */
    public $no;

    /**
     * @var String $description
     */
    public $description;

    /**
     * @var AnswerViewModel[] $answers
     */
    public $answers;

    /**
     * QuestionViewModel constructor.
     * @param int $no
     * @param String $description
     * @param AnswerViewModel[] $answers
     */
    public function __construct(int $no, String $description, array $answers)
    {
        $this->no = $no;
        $this->description = $description;
        $this->answers = $answers;
    }
}
