<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\SubmittedMaterial as SubmittedMaterialModel;
use App\Ods\Elearning\Admin\Entities\SubmittedMaterial;

class SubmittedMaterialRepository
{
    public function all() : array
    {
        $submittedMaterials = SubmittedMaterialModel::all();
        foreach ($submittedMaterials as $submittedMaterial) {
            $submittedMaterial->created_at_string = $submittedMaterial->getCreatedAt();
            $submittedMaterial->updated_at_string = $submittedMaterial->getUpdatedAt();
        }

        return $submittedMaterials;
    }

    public function find(string $id) : SubmittedMaterial
    {
        $submittedMaterial = SubmittedMaterialModel::find($id);
        $submittedMaterial->created_at_string = $submittedMaterial->getCreatedAt();
        $submittedMaterial->updated_at_string = $submittedMaterial->getUpdatedAt();

        return new SubmittedMaterial($submittedMaterial);
    }

    public function findByTopic($topic){
        $submittedMaterials = $topic->getInstance()->materials;
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

    public function delete(SubmittedMaterial $material) : void
    {
        $material->getInstance()->delete();
    }
}
