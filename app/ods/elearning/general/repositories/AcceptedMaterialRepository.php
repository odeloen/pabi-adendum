<?php

namespace App\Ods\Elearning\General\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\General\Entities\AcceptedMaterial;
use Illuminate\Support\Collection;

class AcceptedMaterialRepository {

    public function find(String $id) : AcceptedMaterial
    {
        $material = AcceptedMaterialModel::find($id);
        $material->created_at_string = $material->getCreatedAt();
        $material->updated_at_string = $material->getUpdatedAt();

        $material = new AcceptedMaterial($material);

        if (!$material->instance->isPublic()) {
            return null;
        }

        return $material;
    }

    public function findPublic() : Collection
    {
        $acceptedMaterials = AcceptedMaterialModel::where('public', 1)->get();
        foreach ($acceptedMaterials as $acceptedMaterial) {
            $acceptedMaterial->created_at_string = $acceptedMaterial->getCreatedAt();
            $acceptedMaterial->updated_at_string = $acceptedMaterial->getUpdatedAt();
        }

        $res = [];
        if (!empty($acceptedMaterials)){
            foreach ($acceptedMaterials as $material) {
                $temp = new AcceptedMaterial($material);
                $res[] = $temp;
            }
        }

        return collect($res)->sortBy('instance.name');
    }
}
