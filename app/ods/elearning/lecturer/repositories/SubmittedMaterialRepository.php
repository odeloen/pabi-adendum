<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\SubmittedMaterial as SubmittedMaterialModel;
use App\Ods\Elearning\Lecturer\Entities\SubmittedMaterial;

class SubmittedMaterialRepository
{
    public function find(string $id) : SubmittedMaterial
    {
        $submittedMaterial = SubmittedMaterialModel::withTrashed()->find($id);
        $submittedMaterial->created_at_string = $submittedMaterial->getCreatedAt();
        $submittedMaterial->updated_at_string = $submittedMaterial->getUpdatedAt();

        return new SubmittedMaterial($submittedMaterial);
    }

    public function findByTopic($topic){
        $submittedMaterials = SubmittedMaterialModel::withTrashed()->where('submitted_topic_id', $topic->instance->id)->get();
        foreach ($submittedMaterials as $submittedMaterial) {
            $submittedMaterial->created_at_string = $submittedMaterial->getCreatedAt();
            $submittedMaterial->updated_at_string = $submittedMaterial->getUpdatedAt();
        }

        $materials = [];
        foreach ($submittedMaterials as $submittedMaterial) {
            $material = new Submittedmaterial($submittedMaterial);
            $materials[] = $material;
        }
        return collect($materials)->sortBy('instance.created_at');
    }

    public function save(SubmittedMaterial $material) : void
    {
        $material->getInstance()->save();
        return;
    }
}
