<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Materials\Material as OriginalMaterial;
use App\Ods\Elearning\Lecturer\Entities\Material;
use App\Ods\Elearning\Lecturer\Entities\Topic;
use Illuminate\Support\Collection;

class OriginalMaterialRepository
{
    public function create($topicID, $name, $type, $content, $description = null) : Material
    {
        $material = Material::create($topicID, $name, $type, $content, $description);
        return $material;
    }

    public function all() : Collection
    {
        $originalmaterials = OriginalMaterial::all();
        foreach ($originalMaterials as $originalMaterial) {
            $originalMaterial->created_at_string = $originalMaterial->getCreatedAt();
            $originalMaterial->updated_at_string = $originalMaterial->getUpdatedAt();
        }

        $materials = [];
        foreach ($originalmaterials as $originalmaterial) {
            $material = new Material($originalmaterial);
            $materials[] = $material;
        }
        return collect($materials);
    }

    public function findByTopic(Topic $topic) : Collection
    {
        $originalMaterials = $topic->getInstance()->materials;
        foreach ($originalMaterials as $originalMaterial) {
            $originalMaterial->created_at_string = $originalMaterial->getCreatedAt();
            $originalMaterial->updated_at_string = $originalMaterial->getUpdatedAt();
        }

        $materials = [];
        foreach ($originalMaterials as $originalMaterial) {
            $material = new Material($originalMaterial);
            $materials[] = $material;
        }
        return collect($materials)->sortBy('instance.created_at');
    }

    public function find(string $id) : Material
    {
        $originalMaterial = OriginalMaterial::find($id);
        $originalMaterial->created_at_string = $originalMaterial->getCreatedAt();
        $originalMaterial->updated_at_string = $originalMaterial->getUpdatedAt();

        $material = new Material($originalMaterial);
        return $material;
    }

    public function save(Material $material) : void
    {
        $material->getInstance()->save();
        return;
    }

    public function delete(Material $material) : void
    {
        $material->getInstance()->delete();
    }
}
