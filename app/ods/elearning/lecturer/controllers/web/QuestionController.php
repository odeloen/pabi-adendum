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
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'quiz_id' => 'required',
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $courseID = $request->course_id;
        $quizID = $request->quiz_id;

        $course = Course::find($courseID);

        if ($course->lock){
            Alert::error("Error", "Kelas sedang dalam pengajuan");
            return back();
        }

        $quiz = OriginalQuiz::find($quizID);

        $no = $quiz->questions->count();

        $question = OriginalQuestion::create($quizID, $no + 1);

        Alert::success("Success", "Berhasil menambah pertanyaan");

        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'quiz_id' => 'required',
            'question_id' => 'required',
            'description' => 'required',
            'answers' => 'required',
            'correct_answer' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $courseID = $request->course_id;
        $quizID = $request->quiz_id;
        $questionID = $request->question_id;
        $description = $request->description;
        $answers = $request->answers;
        $correctAnswer = $request->correct_answer;

        $course = Course::find($courseID);

        if ($course->lock){
            Alert::error("Error", "Kelas sedang dalam pengajuan");
            return back();
        }

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
            'course_id' => 'required',
            'quiz_id' => 'required',
            'question_id' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput($request->all());
        }

        $courseID = $request->course_id;
        $quizID = $request->quiz_id;
        $questionID = $request->question_id;

        $course = Course::find($courseID);

        if ($course->lock){
            Alert::error("Error", "Kelas sedang dalam pengajuan");
            return back();
        }

        $quiz = OriginalQuiz::find($quizID);

        $quiz->removeQuestion($questionID);
        $questions = OriginalQuestion::where('original_quiz_id', $quiz->id)->orderBy('no')->get();

        Alert::success("Success", "Berhasil menghapus pertanyaan");

        return redirect()->route('lecturer.question.show', [$courseID, $quizID, $questions[0]->id]);
    }
}
