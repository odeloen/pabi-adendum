<?php

namespace App\Ods\Elearning\Member\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class FollowCourseUseCase
{
    private $courseRepository;
    private $followerRepository;

    public function __construct($courseRepository, $followerRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->followerRepository = $followerRepository;
    }

    public function execute($courseID, $member) : UseCaseResponse
    {
        $course = $this->courseRepository->find($courseID);
        $followInstance = $this->followerRepository->create($member->id, $course->instance->original_course_id);

        try {
            $this->followerRepository->save($followInstance);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mengikuti kelas');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil mengikuti kelas');

        return $response;
    }
}
