<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Core\Entities\Materials\Material as OriginalMaterial;
use App\Ods\Elearning\Core\Entities\Materials\SubmittedMaterial as SubmittedMaterialModel;
use App\Ods\Elearning\Core\Entities\Materials\Types\MaterialTypeService;
use Ramsey\Uuid\Uuid;

class Material
{
    /** @var OriginalMaterial */
    public $instance;

    public function __construct(OriginalMaterial $material)
    {
        $this->instance = $material;
        $this->type = MaterialTypeService::getMaterialType($material);
        $this->type->id = $this->type->getID();
        $this->type->icon = $this->type->getIcon();
        $this->type->view = $this->type->getView();
    }

    /** @return OriginalMaterial */
    public function getInstance(){
        return $this->instance;
    }

    public static function create($topicID, $name, $type, $content, $description = null){
        $material = new OriginalMaterial();
        $material->id = Uuid::uuid4()->toString();
        $material->topic_id = $topicID;
        $material->name = $name;
        $material->type = $type;
        $material->public = false;

        $type = MaterialTypeService::getMaterialType($material);
        $type->update($material, $content, $description);

        $material->setCreated();

        return new Material($material);
    }

    public function update($name, $content, $description = null){
        $this->instance->name = $name;

        $type = MaterialTypeService::getMaterialType($this->instance);
        $type->update($this->instance, $content, $description);

        $this->instance->setUpdated();
    }

    public function delete(){
        if ($this->instance->isCreated()) {
            return true;
        } else  {
            $this->instance->setDeleted();
            return false;
        }
    }

    public function makeSubmitCopy(SubmittedTopic $submittedTopic){
        $submission = new SubmittedMaterialModel();
        $submission->id = Uuid::uuid4()->toString();
        $submission->original_material_id = $this->instance->id;
        $submission->submitted_topic_id = $submittedTopic->instance->id;
        $submission->name = $this->instance->name;
        $submission->description = $this->instance->description;
        $submission->type = $this->instance->type;
        $submission->video_path = $this->instance->video_path;
        $submission->file_name=  $this->instance->file_name;
        $submission->file_path = $this->instance->file_path;
        $submission->post_content = $this->instance->post_content;
        $submission->public = $this->instance->public;
        $submission->modifier = $this->instance->getActionID();

        return new SubmittedMaterial($submission);
    }
}
