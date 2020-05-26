<?php


namespace App\Ods\Elearning\Core\Entities\Questions;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AcceptedQuestion
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
class AcceptedQuestion extends Model
{
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'original_questions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * @var array $answers
     * an associative array for viewing purposes
     * this variable will store randomized answer
     * for example answers[a] will give you precomputed randomized answer (from answer_a to answer_e)
     */
    public $answers;
}
