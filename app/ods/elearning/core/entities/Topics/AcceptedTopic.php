<?php

namespace App\Ods\Elearning\Core\Entities\Topics;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AcceptedTopic extends Model
{
    protected $connection = 'odssql';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    /** @return Topic */
    public function origin(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Topics\Topic', 'original_topic_id', 'id');
    }

    /** @return AcceptedCourse */
    public function course(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\AcceptedCourse', 'accepted_course_id', 'id');
    }

    /** @return array */
    public function materials(){
        return $this->hasMany(Naming::getNamespace().'Entities\Materials\AcceptedMaterial', 'accepted_topic_id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
