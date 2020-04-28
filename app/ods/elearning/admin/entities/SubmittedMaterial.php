<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial;
use App\Ods\Elearning\Core\Entities\Materials\SubmittedMaterial as SubmittedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;
use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic;

class SubmittedMaterial
{
    /** @var SubmittedMaterialModel */
    public $instance;

    public function __construct(SubmittedMaterialModel $material)
    {
        $this->instance = $material;
        $this->type = MaterialTypeService::getMaterialType($material);
        $this->type->id = $this->type->getID();
        $this->type->icon = $this->type->getIcon();
        $this->type->view = $this->type->getView();
    }

    public function getInstance(){
        return $this->instance;
    }

    public function isPublic(){
        return $this->instance->public;
    }

    public function original() : OriginalMaterial
    {
        return new OriginalMaterial($this->instance->origin);
    }

    public function setDeclined(){
        $this->instance->setDeclined();
    }

    public function setComment($comment){
        $this->instance->comment = $comment;
    }
}
