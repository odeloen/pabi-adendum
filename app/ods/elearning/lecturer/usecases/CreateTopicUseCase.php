<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class CreateTopicUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {                
        $topicRepository = $useCaseRequest->topicRepository;
        $courseRepository = $useCaseRequest->courseRepository;

        $courseID = $useCaseRequest->userRequest->course_id;
        $name = $useCaseRequest->userRequest->name;
        $description = $useCaseRequest->userRequest->description;

        $topic = $topicRepository->create($courseID, $name, $description);

        $course = $courseRepository->find($courseID);

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        $course->instance->setUpdated();

        try {
            $topicRepository->save($topic);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat topik');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat topik');

        return $response;
    }
}
