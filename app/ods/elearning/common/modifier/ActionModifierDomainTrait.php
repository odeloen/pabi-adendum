<?php


namespace App\Ods\Elearning\Common\Modifier;


Trait ActionModifierDomainTrait
{
    /**
     * @var int $modifier
     */
    private $modifier;

    /**
     * @return int
     */
    public function getModifier(){
        return $this->modifier;
    }

    public function isModified(){
        if (!isset($this->modifier)) return false;
        return $this->modifier !== null;
    }

    public function isCreated(){
        if (!isset($this->modifier)) return false;
        return $this->modifier == ActionModifier::Created;
    }

    public function isUpdated(){
        if (!isset($this->modifier)) return false;
        return $this->modifier == ActionModifier::Updated;
    }

    public function isDeleted(){
        if (!isset($this->modifier)) return false;
        return $this->modifier == ActionModifier::Deleted;
    }

    protected function markCreated(){
        $this->modifier = ActionModifier::Created;
    }

    protected function markUpdated(){
        if ($this->isCreated()) return;
        $this->modifier = ActionModifier::Updated;
    }

    public function markDeleted(){
        if ($this->isCreated()) return;
        $this->modifier = ActionModifier::Deleted;
    }

    public function canBeDeleted(){
        if ($this->isCreated()) return true;
        else return false;
    }

    public function setNoModifier(){
        $this->modifier = ActionModifier::Unmodified;
    }
}
