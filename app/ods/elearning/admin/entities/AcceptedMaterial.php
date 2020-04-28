<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;
use Ramsey\Uuid\Uuid;

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

    /** @return AcceptedMaterialModel */
    public function getInstance(){
        return $this->instance;
    }

    public static function createFromSubmitted(SubmittedMaterial $material, AcceptedTopic $topic) : AcceptedMaterial
    {
        $acceptedMaterial =  new AcceptedMaterialModel();
        $acceptedMaterial->id = Uuid::uuid4()->toString();

        $acceptedMaterial->accepted_topic_id = $topic->instance->id;
        $acceptedMaterial->original_material_id = $material->instance->original_material_id;

        $acceptedMaterial->name = $material->instance->name;
        $acceptedMaterial->description = $material->instance->description;
        $acceptedMaterial->type = $material->instance->type;
        $acceptedMaterial->video_path = $material->instance->video_path;
        $acceptedMaterial->file_name = $material->instance->file_name;
        $acceptedMaterial->file_path = $material->instance->file_path;
        $acceptedMaterial->post_content = $material->instance->post_content;
        $acceptedMaterial->public = $material->instance->public;

        $acceptedMaterial = new AcceptedMaterial($acceptedMaterial);

        return $acceptedMaterial;
    }
}
