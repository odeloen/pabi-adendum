<?php

namespace App\Ods\Elearning\Member\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class UnfollowCourseUseCase 
{
    private $courseRepository;
    private $followerRepository;

    public function __construct($courseRepository, $followerRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->followerRepository = $followerRepository;
    }

    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseID = $useCaseRequest->userRequest->course_id;
        $member = $useCaseRequest->userRequest->member;

        $course = $this->courseRepository->find($courseID);

        $followInstance = $this->followerRepository->find($member->id, $course->instance->original_course_id);

        try {
            $this->followerRepository->delete($followInstance);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal berhenti mengikuti kelas');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil berhenti mengikuti kelas');

        return $response;
    }
}
