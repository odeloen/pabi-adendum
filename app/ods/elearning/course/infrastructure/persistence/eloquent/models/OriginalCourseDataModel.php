<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OriginalCourseDataModel
 * @package App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models
 * @mixin \Eloquent
 */
class OriginalCourseDataModel extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'courses';

    public $incrementing = false;
}
