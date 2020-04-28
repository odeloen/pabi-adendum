<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetSubmittedCourseListUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;
        $originalCourseRepository = $useCaseRequest->originalCourseRepository;
        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;

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
            $originalCourse = $originalCourseRepository->find($courseID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan kelas terkait');
            return $response;
        }

        try {
            $submittedCourses = $submittedCourseRepository->findByCourse($originalCourse);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan daftar pengajuan terkait');
            return $response;
        }

        $data = [
            'lecturer' => $lecturer,
            'course' => $originalCourse,
            'submissions' => $submittedCourses,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
