<?php

namespace App\Ods\Elearning\Member\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Member\Entities\AcceptedMaterial;
use App\Ods\Elearning\Member\Entities\AcceptedTopic;

class AcceptedMaterialRepository
{
    public function find(string $id) : AcceptedMaterial
    {
        $acceptedMaterial = AcceptedMaterialModel::find($id);
        $acceptedMaterial->created_at_string = $acceptedMaterial->getCreatedAt();
        $acceptedMaterial->updated_at_string = $acceptedMaterial->getUpdatedAt();

        $material = new AcceptedMaterial($acceptedMaterial);

        return $material;
    }

    public function findByTopic(AcceptedTopic $topic){
        $acceptedMaterials = $topic->instance->materials;
        foreach ($acceptedMaterials as $acceptedMaterial) {
            $acceptedMaterial->created_at_string = $acceptedMaterial->getCreatedAt();
            $acceptedMaterial->updated_at_string = $acceptedMaterial->getUpdatedAt();
        }

        $materials = [];
        foreach ($acceptedMaterials as $acceptedMaterial) {
            $material = new AcceptedMaterial($acceptedMaterial);
            $materials[] = $material;
        }
        return collect($materials)->sortBy('instance.created_at');
    }
}
