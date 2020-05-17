<?php


namespace App\Ods\Elearning\Common\Modifier;


trait ActionModifierViewTrait
{
    use ActionModifierDomainTrait;

    private static $modifierCollection = [
        ['id' => ActionModifier::Created, 'name' => 'create'],
        ['id' => ActionModifier::Updated, 'name' => 'update'],
        ['id' => ActionModifier::Deleted, 'name' => 'delete'],
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
