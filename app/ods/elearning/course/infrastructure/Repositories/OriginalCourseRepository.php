<?php


namespace App\Ods\Elearning\Course\Infrastructure\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Infrastructure\Models\OriginalCourse;

class OriginalCourseRepository implements ICourseRepository
{
    private $topicRepository;
    private $materialRepository;

    private $submissionRepository;

    /**
     * OriginalCourseRepository constructor.
     */
    public function __construct()
    {
        $this->topicRepository = new OriginalTopicRepository();
        $this->materialRepository = new OriginalMaterialRepository();
        $this->submissionRepository = new SubmittedCourseRepository();
    }

    private function convertToEntity(OriginalCourse $originalCourse)
    {
        $topics = $this->topicRepository->findByCourse($originalCourse);

        $course = new Course($originalCourse->id, $originalCourse->name, $originalCourse->description, $originalCourse->lecturer);
        $course->setTopics();
    }

    private function convertToDataModel(Course $course)
    {

    }

    public function insert($course)
    {
        // TODO: Implement insert() method.
    }

    public function update($course)
    {
        // TODO: Implement update() method.
    }

    public function saveImage($course, $image)
    {
        // TODO: Implement saveImage() method.
    }

    public function findByID($ID): Course
    {
        // TODO: Implement findByID() method.
    }

    public function findByLecturer($lecturerID)
    {
        // TODO: Implement findByLecturer() method.
    }
}
