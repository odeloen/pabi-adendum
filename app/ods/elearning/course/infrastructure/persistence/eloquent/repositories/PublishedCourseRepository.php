<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseSearchRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ILecturerRepository;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Models\PublishedCourseDataModel;

class PublishedCourseRepository implements ICourseRepository, ICourseSearchRepository
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

    private function mapDataModelToDomainModel(PublishedCourseDataModel $courseDataModel){
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

    private function mapDomainModelToDataModel(Course $courseDomainModel, PublishedCourseDataModel $courseDataModel){
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
        $courseDataModels = PublishedCourseDataModel::orderBy('created_at')->get();

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
        $courseDataModel = PublishedCourseDataModel::find($courseID);

        if (!isset($courseDataModel)) return null;

        return $this->mapDataModelToDomainModel($courseDataModel);
    }

    public function search($query)
    {
        // TODO: Implement search() method.
    }

    public function insert(Course $course, $image = null)
    {
        // Empty implementation
    }

    public function update(Course $course, $image = null)
    {
        // Empty implementation
    }

    public function delete(Course $course)
    {
        // Empty implementation
    }
}
