<?php


namespace App\Ods\Elearning\Member\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\QuizHistory\QuizHistory;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    /**
     * @param Request $request
     *
     * Returned parameters
     *
     * Course
     * Quiz
     */
    public function preQuiz($courseID){
        $lecturerRepository = new LecturerRepository();

        $course = AcceptedCourse::find($courseID);
        $course->updated_at_string = $course->getUpdatedAt();
        $course->lecturer = $lecturerRepository->find($course->lecturer_id);

        $quiz = AcceptedQuiz::findByCourseID($courseID);

        $data = [
            'course' => $course,
            'quiz' => $quiz
        ];

        return view('Ods\Elearning\Member::quiz.pre-quiz', $data);
    }

    /**
     * @param Request $request
     *
     * Show quiz page
     *
     * Returned parameters
     *
     * Course
     * Quiz and Questions
     * QuizHistory
     */
    public function quiz(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Silahkan coba beberapa saat lagi");
            return back();
        }

        $validator = Validator::make($request->all(), [
            'tac' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Setujui aturan kuis sebelum melanjutkan");
            return back();
        }

        $courseID = $request->course_id;
        $userID = request()->session()->get('pabi_user_id');

        $course = AcceptedCourse::find($courseID);
        $quiz = AcceptedQuiz::takeQuiz($courseID);

        $quizHistory = QuizHistory::create(
            $courseID,
            $quiz->id,
            $userID
        );

        $data = [
            'course' => $course,
            'quiz' => $quiz,
            'quiz_history' => $quizHistory
        ];

        return view('Ods\Elearning\Member::quiz.quiz', $data);
    }

    public function postQuiz(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'quiz_history_id' => 'required',
            'answers' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Gagal menyimpan hasil quiz, cobalah beberapa saat lagi");
            return redirect(); // Redirect to course list
        }

        $lecturerRepository = new LecturerRepository();

        $course = AcceptedCourse::find($request->course_id);
        $course->updated_at_string = $course->getUpdatedAt();
        $course->lecturer = $lecturerRepository->find($course->lecturer_id);

        $quizHistory = QuizHistory::find($request->quiz_history_id);
        $quizHistory->finish($request->answers);

        $data = [
            'quiz_history' => $quizHistory,
            'course' => $course
        ];

        return view('Ods\Elearning\Member::quiz.post-quiz', $data);
    }
}
