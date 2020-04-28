<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class UpdateMaterialUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->courseRepository;
        $materialRepository = $useCaseRequest->materialRepository;

        $materialID = $useCaseRequest->userRequest->material_id;
        $name = $useCaseRequest->userRequest->name;
        $content = $useCaseRequest->userRequest->content;
        $description = $useCaseRequest->userRequest->description;

        if (!empty($content['file'])){
            $content['file'] = $useCaseRequest->userRequest->file('content.file');
        }

        $material = $materialRepository->find($materialID);
        $material->update($name, $content, $description);

        $course = $courseRepository->findByMaterial($material);
        $course->instance->setUpdated();

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        try {
            $materialRepository->save($material);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mengubah topik');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil mengubah topik');

        return $response;
    }
}
