<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Topic;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\SubmittedTopicDataModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class SubmittedTopicRepository implements ITopicRepository
{
    /**
     * @var IMaterialRepository
     */
    private $materialRepository;

    /**
     * OriginalTopicRepository constructor.
     * @param IMaterialRepository $materialRepository
     */
    public function __construct(IMaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function getMaterialRepository()
    {
        return $this->materialRepository;
    }

    private function mapDataModelToDomainModel(SubmittedTopicDataModel $topicDataModel){
        $materials = $this->materialRepository->findByTopicID($topicDataModel->id);

        $topicDomainModel = Topic::createFromExisting(
            $topicDataModel->id,
            $topicDataModel->course_id,
            $topicDataModel->name,
            $topicDataModel->description,
            $materials,
            $topicDataModel->modifier,
            $topicDataModel->deleted_at,
            $topicDataModel->created_at,
            $topicDataModel->updated_at
        );

        return $topicDomainModel;
    }

    private function mapDomainModelToDataModel(Topic $topicDomainModel, SubmittedTopicDataModel $topicDataModel){
        $topicDataModel->id = $topicDomainModel->getId();
        $topicDataModel->course_id = $topicDomainModel->getCourseID();
        $topicDataModel->name = $topicDomainModel->getName();
        $topicDataModel->description = $topicDomainModel->getDescription();
        $topicDataModel->modifier = $topicDomainModel->getModifier();
        $topicDataModel->deleted_at = $topicDomainModel->getDeletedAt();
        $topicDataModel->created_at = $topicDomainModel->getCreatedAt();
        $topicDataModel->updated_at = $topicDomainModel->getUpdatedAt();

        return $topicDataModel;
    }

    public function findByCourseID(String $courseID)
    {
        $topicDataModels = SubmittedTopicDataModel::where('course_id', $courseID)->orderBy('created_at', 'asc')->get();

        if (!isset($topicDataModels)) return null;

        $topicDomainModels = [];
        foreach ($topicDataModels as $topicDataModel){
            $topicDomainModels[] = $this->mapDataModelToDomainModel($topicDataModel);
        }

        return $topicDomainModels;
    }

    public function findByID(String $topicID)
    {
        $topicDataModel = SubmittedTopicDataModel::find($topicID);

        if (!isset($topicDataModel)) return null;

        $topicDomainModel = $this->mapDataModelToDomainModel($topicDataModel);

        return $topicDomainModel;
    }

    public function insert(Topic $topicDomainModel)
    {
        $topicDataModel = new SubmittedTopicDataModel();
        $topicDataModel = $this->mapDomainModelToDataModel($topicDomainModel, $topicDataModel);

        $topicDataModel->id = Uuid::uuid4()->toString();
        $topicDataModel->created_at = Carbon::now()->toDateTimeString();
        $topicDataModel->updated_at = Carbon::now()->toDateTimeString();

        $topicDataModel->save();
    }

    public function update(Topic $topicDomainModel)
    {
        $topicDataModel = SubmittedTopicDataModel::find($topicDomainModel->getId());
        $topicDataModel = $this->mapDomainModelToDataModel($topicDomainModel, $topicDataModel);
        $topicDataModel->updated_at = Carbon::now()->toDateTimeString();

        $topicDataModel->save();
    }

    public function delete(Topic $topicDomainModel)
    {
        $topicDataModel = SubmittedTopicDataModel::find($topicDomainModel->getId());

        $topicDataModel->delete();
    }
}
