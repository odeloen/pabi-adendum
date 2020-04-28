<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseResponse;

class UpdateCourseUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->courseRepository;

        $courseID = $useCaseRequest->userRequest->course_id;
        $name = $useCaseRequest->userRequest->name;
        $description = $useCaseRequest->userRequest->description;
        $categories = $useCaseRequest->userRequest->categories;

        $courseImage = null;
        if ($useCaseRequest->userRequest->hasFile('image')){
            $courseImage = $useCaseRequest->userRequest->file('image');
        }

        try {
            $course = $courseRepository->find($courseID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal tersambung dengan kelas terkait');
            return $response;
        }

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        $course->update($name, $description, $categories, $courseImage);

        try {
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mengubah detail kelas');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil mengubah detail kelas');

        return $response;
    }
}
