<?php


namespace App\Ods\Elearning\Course\Domain\Usecases;


use App\Ods\Elearning\Course\Domain\Exceptions\RepositoryIsNotAvailableException;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class CreateCourseUsecase
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * CreateCourseUsecase constructor.
     * @param $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(CreateCourseUsecaseRequest $request){
        $course = $request->getCourse();

        try {
            $this->courseRepository->insert($course);
        } catch (\Exception $exception) {
            throw new RepositoryIsNotAvailableException;
        }

        return new CreateCourseUsecaseResponse();
    }
}
