<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class PublishedCourseDataModel
 * @package App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models
 * @mixin \Eloquent
 */
class PublishedCourseDataModel extends Model
{
    protected $connection = 'odssql';
    protected $table = 'accepted_courses';

    public $incrementing = false;
}
