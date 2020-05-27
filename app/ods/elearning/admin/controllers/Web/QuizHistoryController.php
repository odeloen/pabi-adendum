<?php


namespace App\Ods\Elearning\Admin\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Common\Datetime\DateTimeToString;
use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\QuizHistory\QuizHistory;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;

class QuizHistoryController extends Controller
{
    use DateTimeToString;

    public function list(){
        $memberRepository = new MemberRepository();
        $lecturerRepository = new LecturerRepository();

        $quizHistories = QuizHistory::whereNotNull('ended_at')->orderBy('started_at', 'desc')->get();

        if (isset($quizHistories)){
            foreach ($quizHistories as $quizHistory){
                $quizHistory->started_at_string = $this->convertTimeToString($quizHistory->started_at);
                $quizHistory->member = $memberRepository->find($quizHistory->user_id);
                $quizHistory->course = AcceptedCourse::find($quizHistory->accepted_course_id);
                $quizHistory->course->lecturer = $lecturerRepository->find($quizHistory->course->lecturer_id);
            }
        }

        $data = [
            'quiz_histories' => $quizHistories
        ];

        return view('Ods\Elearning\Admin::quiz.result', $data);
    }
}
