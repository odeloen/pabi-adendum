<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ILecturerRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\OriginalCourseDataModel;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class OriginalCourseRepository implements ICourseRepository
{
    /**
     * @var ITopicRepository
     */
    private $topicRepository;

    /**
     * @var ILecturerRepository
     */
    private $lecturerRepository;

    private $imageDirectory = 'ods/course/original/images/';

    /**
     * OriginalCourseRepository constructor.
     * @param ITopicRepository $topicRepository
     * @param ILecturerRepository $lecturerRepository
     */
    public function __construct(ITopicRepository $topicRepository, ILecturerRepository $lecturerRepository)
    {
        $this->topicRepository = $topicRepository;
        $this->lecturerRepository = $lecturerRepository;
    }


    public function getTopicRepository()
    {
        return $this->topicRepository;
    }

    public function getMaterialRepository()
    {
        return $this->topicRepository->getMaterialRepository();
    }

    public function getLecturerRepository()
    {
        return $this->lecturerRepository;
    }

    private function mapDataModelToDomainModel(OriginalCourseDataModel $courseDataModel){
        $lecturer = $this->lecturerRepository->findByID($courseDataModel->lecturer_id);

        $courseDomainModel = Course::createFromExisting(
            $courseDataModel->id,
            $lecturer,
            $courseDataModel->name,
            $courseDataModel->description,
            $courseDataModel->image_path,
            $courseDataModel->created_at,
            $courseDataModel->updated_at,
            $courseDataModel->modifier,
            $courseDataModel->lock
        );

        return $courseDomainModel;
    }

    private function mapDomainModelToDataModel(Course $courseDomainModel, OriginalCourseDataModel $courseDataModel){
        $courseDataModel->id = $courseDomainModel->getId();
        $courseDataModel->lecturer_id = $courseDomainModel->getLecturer()->getId();
        $courseDataModel->name = $courseDomainModel->getName();
        $courseDataModel->description = $courseDomainModel->getDescription();
        $courseDataModel->modifier = $courseDomainModel->getModifier();
        $courseDataModel->image_path = $courseDomainModel->getImagePath();
        $courseDataModel->deleted_at = $courseDomainModel->getDeletedAt();
        $courseDataModel->created_at = $courseDomainModel->getCreatedAt();
        $courseDataModel->updated_at = $courseDomainModel->getUpdatedAt();

        return $courseDataModel;
    }

    public function all()
    {
        // Empty implementation
    }

    public function findByLecturer(Lecturer $lecturer)
    {
        $courseDataModels = OriginalCourseDataModel::where('lecturer_id', $lecturer->getId())->get();

        if (!isset($courseDataModels)) return null;

        $courseDomainModels = [];
        foreach ($courseDataModels as $courseDataModel){
            $courseDomainModels[] = $this->mapDataModelToDomainModel($courseDataModel);
        }

        return $courseDomainModels;
    }

    public function findByID(String $courseID)
    {
        $courseDataModel = OriginalCourseDataModel::find($courseID);

        if (!isset($courseDataModel)) return null;

        return $this->mapDataModelToDomainModel($courseDataModel);
    }

    public function insert(Course $courseDomainModel, $image = null)
    {
        $courseDataModel = new OriginalCourseDataModel();
        $courseDataModel = $this->mapDomainModelToDataModel($courseDomainModel, $courseDataModel);

        $courseDataModel->id = Uuid::uuid4()->toString();
        $courseDataModel->created_at = Carbon::now()->toDateTimeString();
        $courseDataModel->updated_at = Carbon::now()->toDateTimeString();
        $courseDataModel = $this->insertImage($courseDataModel, $image);

        $courseDataModel->save();
    }

    public function update(Course $courseDomainModel, $image = null)
    {
        $courseDataModel = OriginalCourseDataModel::find($courseDomainModel->getId());
        $courseDataModel = $this->mapDomainModelToDataModel($courseDomainModel, $courseDataModel);

        $courseDataModel->updated_at = Carbon::now()->toDateTimeString();
        $this->insertImage($courseDataModel, $image);

        $courseDataModel->save();
    }

    public function delete(Course $courseDomainModel)
    {
        $courseDataModel = OriginalCourseDataModel::find($courseDomainModel->getId());

        $courseDataModel = $this->deleteImage($courseDataModel);

        $courseDataModel->delete();
    }

    private function insertImage(OriginalCourseDataModel $courseDataModel, UploadedFile $image = null){
        if (empty($image)) return $courseDataModel;

        if (isset($courseDataModel->image_path) && file_exists(storage_path('app/' . $courseDataModel->image_path))) {
            unlink(storage_path('app/'.$courseDataModel->image_path));
        }

        $fullFilePath = $image->store('public/'.$this->imageDirectory);
        $tempArray = explode('/', $fullFilePath);

        $fileName = end($tempArray);
        $filePath = $this->imageDirectory.$fileName;

        $courseDataModel->image_path = $filePath;

        return $courseDataModel;
    }

    private function deleteImage(OriginalCourseDataModel $courseDataModel){
        if (isset($courseDataModel->image_path) && file_exists(storage_path('app/' . $courseDataModel->image_path))) {
            unlink(storage_path('app/' . $courseDataModel->image_path));
        }

        $courseDataModel->image_path = null;

        return $courseDataModel;
    }
}
