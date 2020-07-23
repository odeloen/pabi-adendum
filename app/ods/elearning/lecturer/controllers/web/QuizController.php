<?php


namespace App\Ods\Elearning\Lecturer\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Core\Entities\Courses\Course;
use App\Ods\Elearning\Core\Entities\Questions\OriginalQuestion;
use App\Ods\Elearning\Core\Entities\Quizzes\OriginalQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function show($courseID){
        try {
            $course = Course::find($courseID);
            $quiz = OriginalQuiz::findByCourseID($courseID);
        } catch (\Exception $e) {
            Alert::error("Error", $e->getMessage());
            return back();
        }

        // if quiz is not found, then create new quiz for the course
        if (!isset($quiz)) {
            DB::beginTransaction();
            try {
                $quiz = OriginalQuiz::create($courseID);
                $question = OriginalQuestion::create($quiz->id, 1);
                $quiz->questions;
            } catch (\Exception $exception) {
                DB::rollBack();
                Alert::error("Error", $exception->getMessage());
                return back();
            }
            DB::commit();
        }

        return redirect()->route('lecturer.question.show', [$courseID, $quiz->id, $quiz->questions[0]->id]);
    }

    public function create(Request $request){

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'quiz_id' => 'required',
            'duration' => 'required|numeric',
            'threshold' => 'required|numeric',
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap atau ada yang salah");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $courseID = $request->course_id;
        $quizID = $request->quiz_id;
        $duration = $request->duration;
        $threshold = $request->threshold;

        $course = Course::find($courseID);

        if ($course->lock){
            Alert::error("Error", "Kelas sedang dalam pengajuan");
            return back();
        }

        $quiz = OriginalQuiz::find($quizID);

        $quiz->edit($duration, $threshold);

        Alert::success("Success", "Berhasil mengubah detail kelas");

        return back();
    }

    public function delete(Request $request){

    }
}
