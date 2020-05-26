<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OriginalTopicDataModel
 * @package App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models
 * @mixin \Eloquent
 */
class OriginalTopicDataModel extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'topics';

    public $incrementing = false;

    public function course(){
        return $this->belongsTo(
            OriginalCourseDataModel::class,
            'course_id',
            'id'
        );
    }

    public function materials(){
        return $this->hasMany(OriginalMaterialDataModel::class);
    }
}
