<?php


namespace App\Ods\Elearning\Core\Entities\Quizzes;


use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use App\Ods\Elearning\Core\Entities\Questions\OriginalQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * Class OriginalQuiz
 * @package App\Ods\Elearning\Core\Entities\Quizzes
 * @mixin \Eloquent
 *
 * Aggregate root for Original Quiz Domain
 *
 * Properties
 * @property String $id
 * @property String $original_course_id
 * @property String $accepted_quiz_id
 * @property \Carbon\Carbon $duration
 * @property int $threshold
 * @property int $question_count
 * @property String $correct_answers
 *
 * Relationships
 * @property OriginalQuestion[] $questions
 */
class OriginalQuiz extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'original_quizzes';
    protected $primaryKey = 'id';


    public $incrementing = false;

    /**
     * @param String $courseID
     * @param String $duration
     * @param int $threshold
     * @return OriginalQuiz
     * @throws \Exception
     */
    public static function create(
        String $courseID
    ){
        $quiz = new OriginalQuiz();

        $quiz->id = Uuid::uuid4()->toString();
        $quiz->original_course_id = $courseID;

        $quiz->save();

        return $quiz;
    }

    /**
     * @param String $duration
     * @param int $threshold
     */
    public function edit(
        String $duration,
        int $threshold
    ){
        $this->duration = $duration;
        $this->threshold = $threshold;

        $this->save();
    }

    /**
     * @param String $courseID
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function findByCourseID(String $courseID){
        $quiz = OriginalQuiz::where('original_course_id', $courseID)->first();

        if (!isset($quiz)) return null;

        $quiz->questions;

        return $quiz;
    }

    /**
     * Eloquent relationship for fetching questions from database
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function questions(){
        return $this->hasMany(OriginalQuestion::class, 'original_quiz_id', 'id')->orderBy('no');
    }

    public function addQuestion(){
        $this->question_count++;
        $question = OriginalQuestion::create($this->id, $this->question_count);

        $this->save();

        return $question;
    }

    /**
     * @param String $questionID
     * @param String $description
     * @param array $answers
     * @param String $correctAnswer
     * @throws \Exception
     */
    public function updateQuestion(
        String $questionID,
        String $description,
        array $answers,
        String $correctAnswer = null
    ){
        $question = OriginalQuestion::find($questionID);
        $question->edit($description, $answers, $correctAnswer);

        $this->save();
    }

    /**
     * @param String $questionID
     * @throws \Exception
     */
    public function removeQuestion(
        String $questionID
    ){
        $question = OriginalQuestion::find($questionID);

        for ($i = $question->no - 1; $i < strlen($this->correct_answers); $i++){
            $this->correct_answers[$i] = $this->correct_answers[$i + 1];
        }
        if (isset($question->answer_a)) $this->correct_answers = substr_replace($this->correct_answers ,"",-1);
        $this->question_count--;

        $this->save();
        $question->delete();
    }

    /**
     * Method for checking validity before submission
     * @return bool
     */
    public function isValidForSubmit(){
        $validStatus = true;

        if (!isset($this->duration)) $validStatus = false;
        if (strlen($this->correct_answers) != $this->question_count) $validStatus = false;

        foreach ($this->questions as $question){
            if (!$question->isValid()) $validStatus = false;
        }

        return $validStatus;
    }
}
