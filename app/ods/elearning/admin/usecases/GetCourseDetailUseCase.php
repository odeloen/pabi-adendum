<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;

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
            $lecturer = $lecturerRepository->find($course->instance->lecturer_id);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan pengajar terkait');
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
            $quiz = AcceptedQuiz::findByCourseID($courseID);
        } catch (\Exception $e) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan quiz terkait');
            return $response;
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
            'quiz' => $quiz,
        ];
        // dd($data);

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
