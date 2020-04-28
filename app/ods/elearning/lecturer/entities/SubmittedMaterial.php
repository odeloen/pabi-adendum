<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Entities\Materials\SubmittedMaterial as SubmittedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;

class SubmittedMaterial
{
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
}
