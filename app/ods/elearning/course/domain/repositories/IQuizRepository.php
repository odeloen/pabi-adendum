<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\ods\elearning\course\domain\entities\Quiz;

interface IQuizRepository
{
    public function findByCourseID(String $courseID);
    public function findByID(String $quizID);

    public function insert(Quiz $quiz);
    public function update(Quiz $quiz);
    public function delete(Quiz $quiz);
}
