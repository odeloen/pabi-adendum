<?php

namespace App\Ods\Elearning\Core\Entities\Topics;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Courses\Course;
use App\Ods\Elearning\Core\Entities\Materials\Material;
use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;
    use ActionModifier;

    protected $connection = 'odssql';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    /** @return Course */
    public function course(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Courses\Course', 'course_id', 'id');
    }

    /** @return array */
    public function materials(){
        return $this->hasMany(Naming::getNamespace().'Entities\Materials\Material', 'topic_id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
