<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class CreateCourseUseCase 
{       
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;
        $courseRepository = $useCaseRequest->courseRepository;

        $lecturer = $lecturerRepository->findAuthenticated();

        $name = $useCaseRequest->userRequest->name;
        $description = $useCaseRequest->userRequest->description;
        $categories = $useCaseRequest->userRequest->categories;

        $courseImage = null;
        if ($useCaseRequest->userRequest->hasFile('image')){
            $courseImage = $useCaseRequest->userRequest->file('image');
        }

        $course = $courseRepository->create($lecturer->id, $name, $description, $categories, $courseImage);

        try {
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal membuat kelas');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat kelas');

        return $response;
    }
}
