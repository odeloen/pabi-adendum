<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Entities\Topic;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\OriginalMaterialDataModel;

class OriginalMaterialRepository implements IMaterialRepository
{
    private function mapDataModelToDomainModel(OriginalMaterialDataModel $materialDataModel){

    }

    private function mapDomainModelToDataModel(Material $materialDomainModel, OriginalMaterialDataModel $materialDataModel){

    }

    public function findByTopicID(String $topicID)
    {
        $materialDataModels = OriginalMaterialDataModel::where('topic_id', $topicID)->get();

        if (!isset($materialDataModels)) return null;

        $materialDomainModels = [];
        foreach ($materialDataModels as $materialDataModel){
            $materialDomainModels[] = $this->mapDataModelToDomainModel($materialDataModel);
        }

        return $materialDomainModels;
    }

    public function findByID(String $materialID)
    {
        $materialDataModel = OriginalMaterialDataModel::find($materialID);

        if (!isset($materialDataModel)) return null;

        return $this->mapDataModelToDomainModel($materialDataModel);
    }

    public function insert(Material $material)
    {
        // TODO: Implement insert() method.
    }

    public function update(Material $material)
    {
        // TODO: Implement update() method.
    }

    public function delete(Material $material)
    {
        // TODO: Implement delete() method.
    }
}
