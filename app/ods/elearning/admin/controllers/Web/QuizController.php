<?php


namespace App\Ods\Elearning\Admin\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse;
use App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz;

class QuizController extends Controller
{
    public function show($courseID){
        try {
            $course = SubmittedCourse::find($courseID);
            $quiz = SubmittedQuiz::findByCourseID($courseID);
        } catch (\Exception $e) {
            Alert::error("Error", $e->getMessage());
            return back();
        }

        return redirect()->route('admin.question.show', [$courseID, $quiz->id, $quiz->questions[0]->id]);
    }
}
