<?php


namespace App\Ods\Elearning\Quiz\Domain\Repositories;




use App\Ods\Elearning\Quiz\Domain\Entities\Quiz;

interface IQuizRepository
{
    public function findByCourseID(String $courseID);
    public function findByID(String $quizID);

    public function insert(Quiz $quiz);
    public function update(Quiz $quiz);
    public function delete(Quiz $quiz);
}
