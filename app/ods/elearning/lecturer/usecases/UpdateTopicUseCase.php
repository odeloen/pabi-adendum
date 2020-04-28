<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class UpdateTopicUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->courseRepository;
        $topicRepository = $useCaseRequest->topicRepository;

        $topicID = $useCaseRequest->userRequest->topic_id;
        $name = $useCaseRequest->userRequest->name;
        $description = $useCaseRequest->userRequest->description;

        $topic = $topicRepository->find($topicID);
        $topic->update($name, $description);

        $course = $courseRepository->findByTopic($topic);
        $course->instance->setUpdated();

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        try {
            $topicRepository->save($topic);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mengubah topik');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil mengubah topik');

        return $response;
    }
}
