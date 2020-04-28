<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetCourseDetailUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;
        $courseRepository = $useCaseRequest->courseRepository;
        $topicRepository = $useCaseRequest->topicRepository;
        $materialRepository = $useCaseRequest->materialRepository;
        $categoryRepository = $useCaseRequest->categoryRepository;
        $courseID = $useCaseRequest->courseID;

        try {
            $lecturer = $lecturerRepository->findAuthenticated();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan pengajar terkait');
            return $response;
        }

        if ($lecturer == null){
            $response = UseCaseResponse::createErrorResponse('Silahkan login terlebih dulu');
            return $response;
        }

        try {
            $course = $courseRepository->find($courseID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan kelas terkait');
            return $response;
        }

        if ($course == null) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan kelas terkait');
            return $response;
        }

        try {
            $course->topics = $topicRepository->findByCourse($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan topik terkait');
            return $response;
        }

        if ($course->topics != null){
            try {
                foreach($course->topics as $topic){
                    $topic->materials = $materialRepository->findByTopic($topic);
                }
            } catch (\Throwable $th) {
                $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan materi terkait');
                return $response;
            }
        }

        try {
            $categories = $categoryRepository->all();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan daftar kategori');
            return $response;
        }

        $data = [
            'lecturer' => $lecturer,
            'course' => $course,
            'categories' => $categories,
        ];
        // dd($data);

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
