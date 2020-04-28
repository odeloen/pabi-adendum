<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Admin\Entities\AcceptedMaterial;
use App\Ods\Elearning\Admin\Entities\AcceptedTopic;
use App\Ods\Elearning\Admin\Entities\SubmittedMaterial;
use Illuminate\Support\Collection;


class AcceptedMaterialRepository
{
    public function create(SubmittedMaterial $submittedMaterial, AcceptedTopic $acceptedTopic) : AcceptedMaterial
    {
        $material = AcceptedMaterial::createFromSubmitted($submittedMaterial, $acceptedTopic);
        return $material;
    }

    public function find(string $id) : AcceptedMaterial
    {
        $material = AcceptedMaterialModel::find($id);
        $material = new AcceptedMaterial($material);
        $material->categories = $material->instance->categories;
        return $material;
    }

    public function findByTopic(AcceptedTopic $topic) : Collection
    {
        $acceptedMaterials = $topic->getInstance()->materials;
        $materials = [];
        foreach ($acceptedMaterials as $acceptedMaterial) {
            $material = new AcceptedMaterial($acceptedMaterial);
            $materials[] = $material;
        }
        return collect($materials)->sortBy('instance.created_at');
    }

    public function save(AcceptedMaterial $material) : void
    {
        $material->getInstance()->save();
    }

    public function delete(AcceptedMaterial $material) : void
    {
        $material->getInstance()->delete();
    }
}
