<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\Material as OriginalMaterialModel;
use App\Ods\Elearning\Admin\Entities\OriginalMaterial;
use App\Ods\Elearning\Admin\Entities\SubmittedMaterial;

class OriginalMaterialRepository
{
    public function find(string $id) : OriginalMaterial
    {
        $material = OriginalMaterialModel::find($id);
        $material = new OriginalMaterial($material);
        return $material;
    }

    public function findBySubmission(SubmittedMaterial $submittedMaterial) : OriginalMaterial
    {
        $originalMaterial = $submittedMaterial->instance->origin;
        return new OriginalMaterial($originalMaterial);
    }

    public function save(OriginalMaterial $material) : void
    {
        $material->getInstance()->save();
        return;
    }

    public function delete(OriginalMaterial $material) : void
    {
        $material->getInstance()->delete();
    }
}
