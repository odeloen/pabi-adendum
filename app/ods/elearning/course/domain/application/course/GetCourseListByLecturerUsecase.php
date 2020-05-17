<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class GetCourseListByLecturerUsecase
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * GetCourseListByLecturerUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param Lecturer $lecturer
     * @return UseCaseResponse
     */
    public function execute(Lecturer $lecturer){
        try {
            $courses = $this->courseRepository->findByLecturer($lecturer);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari kelas");
        }

        $data = [
            'courses' => $courses
        ];

        return UseCaseResponse::createDataResponse($data);
    }
}
