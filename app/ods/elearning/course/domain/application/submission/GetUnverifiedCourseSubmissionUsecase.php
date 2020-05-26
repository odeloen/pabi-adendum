<?php


namespace App\Ods\Elearning\Course\Domain\Application\Submission;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class GetUnverifiedCourseSubmissionUsecase
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * SubmitCourseUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(){
        try {
            $courses = $this->courseRepository->all();
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal mencari pengajuan");
        }

        return UseCaseResponse::createDataResponse($courses);
    }
}
