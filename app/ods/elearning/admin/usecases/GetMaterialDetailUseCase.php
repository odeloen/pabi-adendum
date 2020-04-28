<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetMaterialDetailUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;
        $courseRepository = $useCaseRequest->courseRepository;
        $topicRepository = $useCaseRequest->topicRepository;
        $materialRepository = $useCaseRequest->materialRepository;

        $lecturer = null;
        $course = null;
        $topic = null;
        $material = null;

        $courseID = $useCaseRequest->userRequest->course_id;
        $course = $courseRepository->find($courseID);

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan kelas terkait');
            return $response;
        }

        try {
            $lecturer = $lecturerRepository->find($course->instance->lecturer_id);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan pengajar terkait');
            return $response;
        }

        try {
            $topicID = $useCaseRequest->userRequest->topic_id;
            $topic = $topicRepository->find($topicID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan topik terkait');
            return $response;
        }

        try {
            $materialID = $useCaseRequest->userRequest->material_id;
            $material = $materialRepository->find($materialID);
        } catch (\Throwable $th) {

        }

        $data = [
            'lecturer' => $lecturer,
            'course' => $course,
            'topic' => $topic,
            'material' => $material,
        ];

        // dd($data);

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
