<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Materials\Material as OriginalMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;

class OriginalMaterial
{
    /** @var OriginalMaterialModel */
    public $instance;

    public function __construct(OriginalMaterialModel $material)
    {
        $this->instance = $material;
        $this->type = MaterialTypeService::getMaterialType($material);
        $this->type->id = $this->type->getID();
        $this->type->icon = $this->type->getIcon();
        $this->type->view = $this->type->getView();
    }

    /** @return OriginalMaterialModel */
    public function getInstance(){
        return $this->instance;
    }

    public function submissionProcessDone(){
        $this->instance->setNoModifier();
    }
}
