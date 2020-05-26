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

class QuestionController extends Controller
{
    public function show($courseID, $quizID, $questionID){
        $course = Course::find($courseID);
        $quiz = OriginalQuiz::find($quizID);
        $active_question = OriginalQuestion::find($questionID);

        $data = [
            'course' => $course,
            'quiz' => $quiz,
            'active_question' => $active_question,
        ];

        return view('Ods\Elearning\Lecturer::quiz.show', $data);
    }

    public function create(Request $request){
        $quizID = $request->quiz_id;

        $quiz = OriginalQuiz::find($quizID);

        $no = $quiz->questions->count();

        $question = OriginalQuestion::create($quizID, $no + 1);

        Alert::success("Success", "Berhasil menambah pertanyaan");

        return back();
    }

    public function update(Request $request){
//        dd($request);

        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'question_id' => 'required',
            'description' => 'required',
            'answers' => 'required',
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $quizID = $request->quiz_id;
        $questionID = $request->question_id;
        $description = $request->description;
        $answers = $request->answers;
        $correctAnswer = $request->correct_answer;

        $quiz = OriginalQuiz::find($quizID);

        DB::beginTransaction();
        try {
            $quiz->updateQuestion($questionID, $description, $answers, $correctAnswer);

        } catch (\Exception $e) {
            DB::rollBack();
        }
        DB::commit();


        Alert::success("Success", "Berhasil mengubah pertanyaan");

        return back();
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'question_id' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $quizID = $request->quiz_id;
        $questionID = $request->question_id;

        $quiz = OriginalQuiz::find($quizID);

        $quiz->removeQuestion($questionID);

        Alert::success("Success", "Berhasil menghapus pertanyaan");

        return back();
    }
}
