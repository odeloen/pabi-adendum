<?php


namespace App\Ods\Elearning\Core\Entities\Quizzes;


use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse;
use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use App\Ods\Elearning\Core\Entities\Questions\AcceptedQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class SubmittedQuiz
 * @package App\Ods\Elearning\Core\Entities\Quizzes
 * @mixin \Eloquent
 *
 * Properties
 * @property String $id
 * @property String $submitted_course_id
 * @property String $original_quiz_id
 * @property \Carbon\Carbon $duration
 * @property int $threshold
 */
class SubmittedQuiz extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'submitted_quizzes';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * @var int $numberOfQuestion
     * not persisted
     */
    public $numberOfQuestion;

    /**
     * @param OriginalQuiz $originalQuiz
     * @param String $submittedCourseID
     * @return SubmittedQuiz
     * @throws \Exception
     */
    public static function create(
        OriginalQuiz $originalQuiz,
        String $submittedCourseID
    ){
        $submittedQuiz = new SubmittedQuiz();

        $submittedQuiz->id = Uuid::uuid4()->toString();
        $submittedQuiz->original_quiz_id = $originalQuiz->id;
        $submittedQuiz->submitted_course_id = $submittedCourseID;
        $submittedQuiz->duration = $originalQuiz->duration;
        $submittedQuiz->threshold = $originalQuiz->threshold;

        $submittedQuiz->save();

        return $submittedQuiz;
    }

    public function findByCourseID(String $courseID){

    }

    /**
     * @param AcceptedQuestion[] $questions
     */
    private function loadQuestions(array $questions){

    }
}
