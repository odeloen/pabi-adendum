<?php


namespace App\Ods\Elearning\Core\Entities\Questions;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class SubmittedQuestion
 * @package App\Ods\Elearning\Core\Entities\Questions
 * @mixin \Eloquent
 *
 * Properties
 * @property String $id
 * @property String $submitted_quiz_id
 * @property String $original_question_id
 * @property int $no used in sorting
 * @property String $description
 * @property String $answer_a
 * @property String $answer_b
 * @property String $answer_c
 * @property String $answer_d
 * @property String $answer_e
 * @property $correct_answer
 */
class SubmittedQuestion extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'submitted_questions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function create(
        OriginalQuestion $originalQuestion,
        String $submittedQuizID
    ){
        $submittedQuestion = new SubmittedQuestion();

        $submittedQuestion->id = Uuid::uuid4()->toString();
        $submittedQuestion->submitted_quiz_id = $submittedQuizID;
        $submittedQuestion->original_question_id = $originalQuestion->id;
        $submittedQuestion->no = $originalQuestion->no;
        $submittedQuestion->description = $originalQuestion->description;
        $submittedQuestion->answer_a = $originalQuestion->answer_a;
        $submittedQuestion->answer_b = $originalQuestion->answer_b;
        $submittedQuestion->answer_c = $originalQuestion->answer_c;
        $submittedQuestion->answer_d = $originalQuestion->answer_d;
        $submittedQuestion->answer_e = $originalQuestion->answer_e;
        $submittedQuestion->correct_answer = $originalQuestion->correct_answer;

        $submittedQuestion->save();

        return $submittedQuestion;
    }
}
