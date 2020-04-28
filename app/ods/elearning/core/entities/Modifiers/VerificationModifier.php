<?php

namespace App\Ods\Elearning\Core\Entities\Modifiers;

trait VerificationModifier
{
    private static $statusCollection = [
        ['id' => 0, 'name' => 'processed'],
        ['id' => 1, 'name' => 'accepted'],
        ['id' => -1, 'name' => 'declined'],
    ];

    public static function statusAll(){
        return static::$statusCollection;
    }

    public static function getStatusAttribute($status){
        return collect(static::$statusCollection)
                ->where('id', $status)
                ->first();
    }

    public function isProcessed(){
        return $this->status['id'] == 0;
    }

    public function isAccepted(){
        return $this->status['id'] == 1;
    }

    public function isDeclined(){
        return $this->status['id'] == -1;
    }

    public function setProcessed(){
        $this->status = 0;
    }

    public function setAccepted(){
        $this->status = 1;
    }

    public function setDeclined(){
        $this->status = -1;
    }

    public function getStatusTag(){
        if ($this->isProcessed()){
            return '<span class="badge badge-default">Diproses</span>';
        } else if ($this->isAccepted()){
            return '<span class="badge badge-success">Diterima</span>';
        } else if ($this->isDeclined()){
            return '<span class="badge badge-danger">Ditolak</span>';
        }
    }

    public function hasComment(){
        if ($this->isProcessed()) return false;
        return $this->comment != null;
    }
}
