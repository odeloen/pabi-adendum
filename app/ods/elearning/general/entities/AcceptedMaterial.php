<?php

namespace App\Ods\Elearning\General\Entities;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;

class AcceptedMaterial {
    public AcceptedMaterialModel $instance;

    public function __construct(AcceptedMaterialModel $acceptedMaterial)
    {
        $this->instance = $acceptedMaterial;
        $this->type = MaterialTypeService::getMaterialType($acceptedMaterial);
        $this->lecturerID = $acceptedMaterial->topic->course->lecturer_id;
        $this->type->id = $this->type->getID();
        $this->type->icon = $this->type->getIcon();
        $this->type->view = $this->type->getView();
    }
}
