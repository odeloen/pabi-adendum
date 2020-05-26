<?php


namespace App\Ods\Elearning\Course\Domain\Application\Submission;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ISubmissionRepository;

class SubmitCourseUsecase
{
    /**
     * @var ISubmissionRepository
     */
    private $submissionRepository;

    /**
     * SubmitCourseUsecase constructor.
     * @param ISubmissionRepository $submissionRepository
     */
    public function __construct(ISubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }


    public function execute(String $courseID){
        try {
            $this->submissionRepository->submit($courseID);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan");
    }
}
