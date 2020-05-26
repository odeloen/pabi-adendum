<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ILecturerRepository;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ISubmissionRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\SubmittedCourseDataModel;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class SubmittedCourseRepository implements ICourseRepository, ISubmissionRepository
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
     * SubmittedCourseRepository constructor.
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

    private function mapDataModelToDomainModel(SubmittedCourseDataModel $courseDataModel){
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

    private function mapDomainModelToDataModel(Course $courseDomainModel, SubmittedCourseDataModel $courseDataModel){
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
        $courseDataModels = SubmittedCourseDataModel::orderBy('created_at')->get();

        if (!isset($courseDataModels)) return null;

        $courseDomainModels = [];
        foreach ($courseDataModels as $courseDataModel){
            $courseDomainModels[] = $this->mapDataModelToDomainModel($courseDataModel);
        }

        return $courseDomainModels;
    }

    public function findByLecturer(Lecturer $lecturer)
    {
        // Empty implementation
    }

    public function findByID(String $courseID)
    {
        $courseDataModel = SubmittedCourseDataModel::find($courseID);

        if (!isset($courseDataModel)) return null;

        return $this->mapDataModelToDomainModel($courseDataModel);
    }

    public function findByCourseID(String $courseID)
    {
        $courseDataModels = SubmittedCourseDataModel::where('original_course_id', $courseID)->get();

        if (!isset($courseDataModels)) return null;

        $courseDomainModels = [];
        foreach ($courseDataModels as $courseDataModel){
            $courseDomainModels[] = $this->mapDataModelToDomainModel($courseDataModel);
        }

        return $courseDomainModels;
    }

    public function insert(Course $courseDomainModel, $image = null)
    {
        $courseDataModel = new SubmittedCourseDataModel();
        $courseDataModel = $this->mapDomainModelToDataModel($courseDomainModel, $courseDataModel);

        $courseDataModel->id = Uuid::uuid4()->toString();
        $courseDataModel->created_at = Carbon::now()->toDateTimeString();
        $courseDataModel->updated_at = Carbon::now()->toDateTimeString();
        $courseDataModel = $this->insertImage($courseDataModel, $image);

        $courseDataModel->save();
    }

    public function update(Course $courseDomainModel, $image = null)
    {
        $courseDataModel = SubmittedCourseDataModel::find($courseDomainModel->getId());
        $courseDataModel = $this->mapDomainModelToDataModel($courseDomainModel, $courseDataModel);

        $courseDataModel->updated_at = Carbon::now()->toDateTimeString();
        $this->insertImage($courseDataModel, $image);

        $courseDataModel->save();
    }

    public function delete(Course $courseDomainModel)
    {
        $courseDataModel = SubmittedCourseDataModel::find($courseDomainModel->getId());

        $courseDataModel = $this->deleteImage($courseDataModel);

        $courseDataModel->delete();
    }

    public function submit(String $courseID)
    {
        // TODO: Implement submit() method.
    }

    public function accept(String $courseID)
    {
        // TODO: Implement accept() method.
    }

    public function decline(String $courseID, $comment)
    {
        // TODO: Implement decline() method.
    }

    private function insertImage(SubmittedCourseDataModel $courseDataModel, UploadedFile $image = null){
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

    private function deleteImage(SubmittedCourseDataModel $courseDataModel){
        if (isset($courseDataModel->image_path) && file_exists(storage_path('app/' . $courseDataModel->image_path))) {
            unlink(storage_path('app/' . $courseDataModel->image_path));
        }

        $courseDataModel->image_path = null;

        return $courseDataModel;
    }
}
