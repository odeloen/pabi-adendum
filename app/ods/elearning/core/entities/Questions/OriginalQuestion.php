<?php


namespace App\Ods\Elearning\Core\Entities\Questions;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class OriginalQuestion
 * @package App\Ods\Elearning\Core\Entities\Questions
 * @mixin \Eloquent
 *
 * Properties
 * @property String $id
 * @property String $original_quiz_id
 * @property int $no used in sorting
 * @property String $description
 * @property String $answer_a
 * @property String $answer_b
 * @property String $answer_c
 * @property String $answer_d
 * @property String $answer_e
 * @property $correct_answer
 */
class OriginalQuestion extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'original_questions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function create(
        String $quizID,
        int $no
    ){
        $question = new OriginalQuestion();
        $question->id = Uuid::uuid4()->toString();
        $question->original_quiz_id = $quizID;
        $question->no = $no;

        $question->save();

        return $question;
    }

    public function edit(
        String $description,
        array $answers, // associative array
        String $correctAnswer = null
    ){
        $this->description = $description;
        $this->answer_a = $answers['a'];
        $this->answer_b = $answers['b'];
        $this->answer_c = $answers['c'];
        $this->answer_d = $answers['d'];
        $this->answer_e = $answers['e'];
        $this->correct_answer = $correctAnswer;

        $this->save();
    }

    public function isValid(){
        $validStatus = true;

        if (!isset($this->description)) {
            $validStatus = false;
        }

        if (!isset($this->answer_a) && $this->answer_a == ""){
            $validStatus = false;
        }

        if (!isset($this->answer_b) && $this->answer_b == ""){
            $validStatus = false;
        }

        if (!isset($this->answer_c) && $this->answer_c == ""){
            $validStatus = false;
        }

        if (!isset($this->answer_d) && $this->answer_d == ""){
            $validStatus = false;
        }

        if (!isset($this->answer_e) && $this->answer_e == ""){
            $validStatus = false;
        }

        if (!isset($this->correct_answer)){
            $validStatus = false;
        }

        return $validStatus;
    }
}
