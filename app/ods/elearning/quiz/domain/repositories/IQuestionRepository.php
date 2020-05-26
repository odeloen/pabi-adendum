<?php


namespace App\Ods\Elearning\Quiz\Domain\Repositories;


use App\Ods\Elearning\Quiz\Domain\Entities\Question;

interface IQuestionRepository
{
    public function findByQuizID(String $quizID);
    public function findByID(String $questionID);

    public function insert(Question $question);
    public function update(Question $question);
    public function delete(Question $question);
}
