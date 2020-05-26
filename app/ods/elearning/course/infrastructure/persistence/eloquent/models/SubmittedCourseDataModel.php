<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubmittedCourseDataModel
 * @package App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models
 * @mixin \Eloquent
 */
class SubmittedCourseDataModel extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'submitted_courses';

    public $incrementing = false;

    public function topics(){
        return $this->hasMany(SubmittedTopicDataModel::class);
    }
}
