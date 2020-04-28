<?php

namespace App\Ods\Elearning\Core\Entities\Materials;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Modifiers\PublicModifier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AcceptedMaterial extends Model
{
    use PublicModifier;

    protected $connection = 'odssql';
    public $incrementing = false;

    public $created_at_string = null;
    public $updated_at_string = null;

    public function origin(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Materials\Material', 'original_material_id', 'id');
    }

    public function topic(){
        return $this->belongsTo(Naming::getNamespace().'Entities\Topics\AcceptedTopic', 'accepted_topic_id', 'id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getUpdatedAt(){
        return Carbon::parse($this->updated_at)->format('d F Y');
    }
}
