<?php

namespace App\Ods\Elearning\Course\Infrastructure\Models;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Modifiers\ActionModifier;
use App\Ods\Elearning\Core\Entities\Modifiers\PublicModifier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OriginalMaterial extends Model
{
    use SoftDeletes;
    use ActionModifier;
    use PublicModifier;

    protected $connection = 'odssql';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    /* @return OriginalTopic */
    public function topic(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Topics\Topic', 'topic_id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
