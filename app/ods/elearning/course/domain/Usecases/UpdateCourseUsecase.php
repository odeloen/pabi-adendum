<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


use App\Ods\Elearning\Course\Domain\Exceptions\CourseDoesNotExistException;
use App\Ods\Elearning\Course\Domain\Exceptions\RepositoryIsNotAvailableException;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class UpdateCourseUsecase
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * UpdateCourseUsecase constructor.
     * @param $courseRepository
     */
    public function __construct($courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(UpdateCourseUsecaseRequest $request){
        $courseID = $request->getCourseID();
        $name = $request->getName();
        $description = $request->getDescription();
        $image = $request->getImage();

        try {
            $course = $this->courseRepository->findByID($courseID);
        } catch (\Exception $exception){
            throw new RepositoryIsNotAvailableException;
        }

        if ($course == null){
            throw new CourseDoesNotExistException();
        }

        $course->update($name, $description);

        if (!empty($image)){
            $this->courseRepository->saveImage($course, $image);
        }

        return new UpdateCourseUsecaseResponse();
    }
}
