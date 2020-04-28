<?php

namespace App\Ods\Elearning\Core\Entities\Modifiers;

trait PublicModifier
{
    public function isPublic(){
        return $this->public;
    }

    public function setPublicModifier($modifier){
        $this->public = $modifier;
    }
}
