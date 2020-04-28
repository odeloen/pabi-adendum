<?php

namespace App\Ods\Elearning\Core\Entities\Modifiers;

trait ActionModifier
{
    private static $modifierCollection = [
        ['id' => 0, 'name' => 'create'],
        ['id' => 1, 'name' => 'update'],
        ['id' => -1, 'name' => 'delete'],
    ];

    public static function modifierAll(){
        return static::$modifierCollection;
    }

    public static function getModifierAttribute($modifier){
        if ($modifier !== null) {
            return collect(static::$modifierCollection)
                ->where('id', $modifier)
                ->first();
        } else {
            return null;
        }
    }

    public function isCreated(){
        if (empty($this->modifier)) return false;
        return $this->modifier['id'] == 0;
    }

    public function isUpdated(){
        if (empty($this->modifier)) return false;
        return $this->modifier['id'] == 1;
    }

    public function isDeleted(){
        if (empty($this->modifier)) return false;
        return $this->modifier['id'] == -1;
    }

    public function isModified(){
        if (empty($this->modifier)) return false;
        return $this->modifier != null;
    }

    public function setCreated(){
        $this->modifier = 0;
    }

    public function setUpdated(){
        if ($this->isCreated()) return;
        $this->modifier = 1;
    }

    public function setDeleted(){
        if ($this->isCreated()) return;
        $this->modifier = -1;
    }

    public function setNoModifier(){
        $this->modifier = null;
    }

    public function getActionID(){
        if (!empty($this->modifier))return $this->modifier['id'];
        else return null;
    }

    public function getActionTag(){
        if ($this->isCreated()){
            return '<span class="label bg-primary">CREATED</span>';
        } else if ($this->isUpdated()){
            return '<span class="label bg-grey">UPDATED</span>';
        } else if ($this->isDeleted()){
            return '<span class="label bg-danger">DELETED</span>';
        }
    }
}
