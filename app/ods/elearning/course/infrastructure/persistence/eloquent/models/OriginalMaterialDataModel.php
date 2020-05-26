<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OriginalMaterialDataModel
 * @package App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models
 * @mixin \Eloquent
 */
class OriginalMaterialDataModel extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';
    protected $table = 'materials';

    public $incrementing = false;

    public function topic(){
        return $this->belongsTo(
            OriginalTopicDataModel::class,
            'topic_id',
            'id');
    }
}
