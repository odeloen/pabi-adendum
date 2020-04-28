<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


use App\Ods\Elearning\Course\Domain\Exceptions\CourseDoesNotExistException;
use App\Ods\Elearning\Course\Domain\Exceptions\RepositoryIsNotAvailableException;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class GetLecturerCourseListUsecase
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * GetLecturerCourseListUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(GetLecturerCourseListUsecaseRequest $request){
        $lecturerID = $request->getLecturerID();

        try {
            $courses = $this->courseRepository->findByLecturer($lecturerID);
        } catch (\Exception $exception) {
            throw new RepositoryIsNotAvailableException;
        }

        if (empty($courses)){
            throw  new CourseDoesNotExistException;
        }

        return new GetLecturerCourseListUsecaseResponse($courses);
    }
}
