<?php

namespace App\Ods\Elearning\Core\Entities\Courses;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AcceptedCourse extends Model
{
    protected $connection = 'odssql';
    public $incrementing = false;

    // public $created_at_string = null;
    // public $updated_at_string = null;

    /** @return Course */
    public function origin(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\Course', 'original_course_id', 'id');
    }

    /** @return array */
    public function topics(){
        return $this->hasMany(Naming::getNamespace().'Entities\Topics\AcceptedTopic', 'accepted_course_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(Naming::getNamespace().'Entities\Categories\Category', 'accepted_course_categories', 'accepted_course_id', 'category_id');
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
