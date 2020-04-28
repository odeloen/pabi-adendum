<?php

namespace App\Ods\Elearning\Core\Entities\Courses;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\VerificationModifier;
use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmittedCourse extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use VerificationModifier;

    protected $connection = 'odssql';
    protected $table = 'submitted_courses';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    /** @return Course */
    public function origin(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\Course', 'original_course_id', 'id');
    }

    /** @return SubmittedTopic */
    public function topics(){
        return $this->hasMany(Naming::getNamespace().'Entities\Topics\SubmittedTopic', 'submitted_course_id', 'id');
    }

    public function lecturer(){
        return $this->belongsTo('App\Ods\Core\Entities\OdsUser', 'lecturer_id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
