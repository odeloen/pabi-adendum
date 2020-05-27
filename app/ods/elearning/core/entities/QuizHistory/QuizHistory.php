<?php


namespace App\Ods\Elearning\Core\Entities\QuizHistory;


use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class QuizHistory
 * @package App\Ods\Elearning\Core\Entities\QuizHistory
 * @mixin \Eloquent
 *
 * Properties
 * @property String $id
 * @property String $accepted_course_id
 * @property String $accepted_quiz_id
 * @property int $user_id
 * @property int $score
 * @property int $verdict
 * @property String $answers
 * @property String $started_at
 * @property String $ended_at
 */
class QuizHistory extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'member_quiz_histories';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function create(
        String $acceptedCourseID,
        String $acceptedQuizID,
        int $userID
    ){
        $quizHistory = new QuizHistory();

        $quizHistory->id = Uuid::uuid4()->toString();
        $quizHistory->accepted_course_id = $acceptedCourseID;
        $quizHistory->accepted_quiz_id = $acceptedQuizID;
        $quizHistory->user_id = $userID;

        $quizHistory->started_at = Carbon::now();

        $quizQuestions = AcceptedQuiz::find($acceptedQuizID)->questions;

        $answers = "";
        foreach ($quizQuestions as $quizQuestion){
            $answers .= "X";
        }
        $quizHistory->answers = $answers;

        $quizHistory->save();

        return $quizHistory;
    }

    public function finish(
        String $answers
    ){
        $this->answers = $answers;
        $this->ended_at = Carbon::now();

        $this->grade();

        $this->save();
    }

    private function grade(){
        $quiz = AcceptedQuiz::find($this->accepted_quiz_id);
        $correctAnswers = $quiz->correct_answers;
        $questionCount = $quiz->questions->count();

        $memberAnswers = $this->answers;

        $rightAnswerCount = 0;
        for($i = 0; $i < $questionCount; $i ++){
            if ($correctAnswers[$i] == $memberAnswers[$i]) $rightAnswerCount++;
        }

        $score = $rightAnswerCount*100;
        $score = $score/$questionCount;
        $this->score = (int) $score;

        if ($score >= $quiz->threshold) $this->verdict = 1;
        else $this->verdict = 0;
    }
}
