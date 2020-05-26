<?php


namespace App\Ods\Elearning\Core\Entities\Quizzes;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use App\Ods\Elearning\Core\Entities\Questions\AcceptedQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class AcceptedQuiz
 * @package App\Ods\Elearning\Core\Entities\Quizzes
 * @mixin \Eloquent
 *
 * Properties
 * @property String $id
 * @property String $accepted_course_id
 * @property String $original_quiz_id
 * @property \Carbon\Carbon $duration
 * @property int $threshold
 * @property String $correct_answers
 */
class AcceptedQuiz extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'original_quizzes';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * @var int $numberOfQuestion
     * not persisted
     */
    public $numberOfQuestion;

    /**
     * @var AcceptedQuestion[] $questions
     */
    public $questions;

    public static function create(
        SubmittedQuiz $submittedQuiz,
        String $acceptedCourseID
    ){
        $acceptedQuiz = new AcceptedQuiz();

        $acceptedQuiz->id = Uuid::uuid4()->toString();
        $acceptedQuiz->original_quiz_id = $submittedQuiz->id;
        $acceptedQuiz->accepted_course_id = $acceptedCourseID;
        $acceptedQuiz->duration = $submittedQuiz->duration;
        $acceptedQuiz->threshold = $submittedQuiz->threshold;
        $acceptedQuiz->correct_answers = $submittedQuiz->correct_answers;

        return $acceptedQuiz;
    }

    public function edit(
        SubmittedQuiz $submittedQuiz
    ) {
        $this->duration = $submittedQuiz->duration;
        $this->threshold = $submittedQuiz->threshold;
        $this->correct_answers = $submittedQuiz->correct_answers;
    }

    public function findByCourseID(String $courseID){

    }

    /**
     * @param AcceptedQuestion[] $questions
     */
    private function loadQuestions(array $questions){

    }
}
