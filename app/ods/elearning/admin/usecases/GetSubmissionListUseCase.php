<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetSubmissionListUseCase
{
    private $submittedCourseRepository;
    private $lecturerRepository;

    public function __construct($submittedCourseRepository, $lecturerRepository){
        $this->submittedCourseRepository = $submittedCourseRepository;
        $this->lecturerRepository = $lecturerRepository;
    }

    public function execute() : UseCaseResponse
    {

        $submissions = $this->submittedCourseRepository->all();

        if (!empty($submissions)){
            foreach ($submissions as $submission) {
                $submission->lecturer = $this->lecturerRepository->find($submission->instance->lecturer_id);
            }
        }

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan pengajuan terkait');
            return $response;
        }

        $data = [
            'submissions' => $submissions,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
