<?php


namespace App\Ods\Elearning\Core\Entities\QuizHistory;


use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property String $finished_at
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
        int $userID,
        int $score
    ){

    }

    public function finish(
        String $answers
    ){

    }

    private function grade(){
        $course = AcceptedCourse::find($this->accepted_course_id);
        $quiz = AcceptedQuiz::find($this->accepted_quiz_id);
    }
}
