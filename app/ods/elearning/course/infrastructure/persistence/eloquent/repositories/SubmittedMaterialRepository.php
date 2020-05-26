<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Constant\MaterialType;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\SubmittedMaterialDataModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class SubmittedMaterialRepository implements IMaterialRepository
{
    private function mapDataModelToDomainModel(SubmittedMaterialDataModel $materialDataModel){
        if ($materialDataModel->type == MaterialType::Post){
            $content['post_content'] = $materialDataModel->post_content;
        } else if ($materialDataModel->type == MaterialType::File) {
            $content['file_path'] = $materialDataModel->file_path;
            $content['file_name'] = $materialDataModel->file_name;
        } else if ($materialDataModel->type == MaterialType::Video) {
            $content['video_content'] = $materialDataModel->video_path;
        }

        $materialDomainModel = Material::createFromExisting(
            $materialDataModel->id,
            $materialDataModel->topic_id,
            $materialDataModel->name,
            $materialDataModel->description,
            $materialDataModel->type,
            $content,
            $materialDataModel->public,
            $materialDataModel->modifier,
            $materialDataModel->deleted_at,
            $materialDataModel->created_at,
            $materialDataModel->updated_at
        );

        return $materialDomainModel;
    }

    private function mapDomainModelToDataModel(Material $materialDomainModel, SubmittedMaterialDataModel $materialDataModel){
        $materialDataModel->id = $materialDomainModel->getId();
        $materialDataModel->topic_id = $materialDomainModel->getTopicID();
        $materialDataModel->name = $materialDomainModel->getName();
        $materialDataModel->description = $materialDomainModel->getDescription();
        $materialDataModel->type = $materialDomainModel->getType();
        $materialDataModel->modifier = $materialDomainModel->getModifier();
        $materialDataModel->public = $materialDomainModel->getPublic();
        $materialDataModel->deleted_at = $materialDomainModel->getDeletedAt();
        $materialDataModel->created_at = $materialDomainModel->getCreatedAt();
        $materialDataModel->updated_at = $materialDomainModel->getUpdatedAt();

        if ($materialDomainModel->getType() === MaterialType::Post){
            $materialDataModel->post_content = $materialDomainModel->getContent()['post_content'];
        } else if ($materialDomainModel->getType() === MaterialType::File) {
            $materialDataModel->file_name = $materialDomainModel->getContent()['file_name'];
            $materialDataModel->file_path = $materialDomainModel->getContent()['file_path'];
        } else if ($materialDomainModel->getType() === MaterialType::Video) {
            $materialDataModel->video_path = $materialDomainModel->getContent()['video_content'];
        }

        return $materialDataModel;
    }

    public function findByTopicID(String $topicID)
    {
        $materialDataModels = SubmittedMaterialDataModel::where('topic_id', $topicID)->get();

        if (!isset($materialDataModels)) return null;

        $materialDomainModels = [];
        foreach ($materialDataModels as $materialDataModel){
            $materialDomainModels[] = $this->mapDataModelToDomainModel($materialDataModel);
        }

        return $materialDomainModels;
    }

    public function findByID(String $materialID)
    {
        $materialDataModel = SubmittedMaterialDataModel::find($materialID);

        if (!isset($materialDataModel)) return null;

        return $this->mapDataModelToDomainModel($materialDataModel);
    }

    public function insert(Material $materialDomainModel)
    {
        $materialDataModel = new SubmittedMaterialDataModel();
        $materialDataModel = $this->mapDomainModelToDataModel($materialDomainModel, $materialDataModel);

        $materialDataModel->id = Uuid::uuid4()->toString();
        $materialDataModel->created_at = Carbon::now()->toDateTimeString();
        $materialDataModel->updated_at = Carbon::now()->toDateTimeString();

        $materialDataModel->save();
    }

    public function update(Material $materialDomainModel)
    {
        $materialDataModel = SubmittedMaterialDataModel::find($materialDomainModel->getId());
        $materialDataModel = $this->mapDomainModelToDataModel($materialDomainModel, $materialDataModel);
        $materialDataModel->updated_at = Carbon::now()->toDateTimeString();

        $materialDataModel->save();
    }

    public function delete(Material $materialDomainModel)
    {
        $materialDataModel = SubmittedMaterialDataModel::find($materialDomainModel->getId());

        $materialDataModel->delete();
    }
}
