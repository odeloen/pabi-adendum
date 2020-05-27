<?php


namespace App\Ods\Elearning\Core\Entities\Quizzes;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use App\Ods\Elearning\Core\Entities\Questions\AcceptedQuestion;
use App\Ods\Elearning\Member\Entities\AnswerViewModel;
use App\Ods\Elearning\Member\Entities\QuestionViewModel;
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
    protected $table = 'accepted_quizzes';
    protected $primaryKey = 'id';
    public $incrementing = false;

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
        $submittedQuestions = $submittedQuiz->questions;
        $acceptedQuiz->updateQuestions($submittedQuestions);

        $acceptedQuiz->save();

        return $acceptedQuiz;
    }

    public function edit(
        SubmittedQuiz $submittedQuiz
    ) {
        $this->duration = $submittedQuiz->duration;
        $this->threshold = $submittedQuiz->threshold;

        $submittedQuestions = $submittedQuiz->questions;
        $this->updateQuestions($submittedQuestions);

        $this->save();
    }

    /**
     * @param String $courseID
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function findByCourseID(String $courseID){
        $quiz = AcceptedQuiz::where('accepted_course_id', $courseID)->first();

        if (!isset($quiz)) return null;

        $quiz->questions;

        return $quiz;
    }

    public static function takeQuiz(String $courseID){
        $quiz = AcceptedQuiz::where('accepted_course_id', $courseID)->first();

        if (!isset($quiz)) return null;

        $quiz->randomizeQuestions();

        return $quiz;
    }

    private function randomizeQuestions(){
        $rawQuestions = $this->questions;

        $randomizedQuestions = [];
        foreach($rawQuestions as $rawQuestion){
            $visitCount = 0;
            $visitedArray = [
                0 => false,
                1 => false,
                2 => false,
                3 => false,
                4 => false
            ];

            $rawAnswers = [
                0 => new AnswerViewModel($rawQuestion->answer_a, 'A'),
                1 => new AnswerViewModel($rawQuestion->answer_b, 'B'),
                2 => new AnswerViewModel($rawQuestion->answer_c, 'C'),
                3 => new AnswerViewModel($rawQuestion->answer_d, 'D'),
                4 => new AnswerViewModel($rawQuestion->answer_e, 'E'),
            ];

            $randomizedAnswers = [];
            while($visitCount < sizeof($visitedArray)) {
                $randomizedVisitor = mt_rand(0, 4);
                while ($visitedArray[$randomizedVisitor]) {
                    $randomizedVisitor = mt_rand(0, 4);
                }

                $randomizedAnswers[] = $rawAnswers[$randomizedVisitor];
                $visitedArray[$randomizedVisitor] = true;
                $visitCount++;
            }

            $randomizedQuestions[] = new QuestionViewModel($rawQuestion->no, $rawQuestion->description, $randomizedAnswers);
        }

        $this->questions = collect($randomizedQuestions);
    }

    /**
     * Eloquent relationship for fetching questions from database
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function questions(){
        return $this->hasMany(AcceptedQuestion::class, 'accepted_quiz_id', 'id')->orderBy('no');
    }

    private function updateQuestions($submittedQuestions){
        $res = "";
        foreach ($submittedQuestions as $submittedQuestion){
            $res .= $submittedQuestion->correct_answer;
        }
        $this->correct_answers = $res;
    }
}
