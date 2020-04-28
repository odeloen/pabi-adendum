<?php

namespace App\Ods\Elearning\Member\Entities;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;

class AcceptedMaterial
{
    /** @var AcceptedMaterialModel */
    public $instance;

    public function __construct(AcceptedMaterialModel $material)
    {
        $this->instance = $material;
        $this->type = MaterialTypeService::getMaterialType($material);
        $this->type->id = $this->type->getID();
        $this->type->icon = $this->type->getIcon();
        $this->type->view = $this->type->getView();
    }
}
