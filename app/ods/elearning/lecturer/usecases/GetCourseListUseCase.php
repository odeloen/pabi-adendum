<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetCourseListUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;
        $courseRepository = $useCaseRequest->courseRepository;
        $categoryRepository = $useCaseRequest->categoryRepository;

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
            $courses = $courseRepository->findByLecturer($lecturer);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar kelas terkait');
            return $response;
        }

        try {
            $categories = $categoryRepository->all();
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar kategori');
            return $response;
        }

        $data = [
            'lecturer' => $lecturer,
            'courses' => $courses,
            'categories' => $categories,
        ];

        // dd($data);

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
