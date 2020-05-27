<?php


namespace App\Ods\Elearning\Admin\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse;
use App\Ods\Elearning\Core\Entities\Questions\SubmittedQuestion;
use App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz;

class QuestionController extends Controller
{
    public function show($courseID, $quizID, $questionID){
        $course = SubmittedCourse::find($courseID);
        $quiz = SubmittedQuiz::find($quizID);
        $active_question = SubmittedQuestion::find($questionID);

        $data = [
            'course' => $course,
            'quiz' => $quiz,
            'active_question' => $active_question,
        ];

        return view('Ods\Elearning\Admin::quiz.quiz', $data);
    }
}
