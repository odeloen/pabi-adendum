<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class CreateTopicUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalTopicRepository = $useCaseRequest->originalTopicRepository;
        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;
        $acceptedTopicRepository = $useCaseRequest->acceptedTopicRepository;

        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;

        $acceptedCourse = $useCaseRequest->acceptedCourse;
        $submittedTopic = $useCaseRequest->submittedTopic;
        $originalTopic = $submittedTopic->original();

        $acceptedTopic = $acceptedTopicRepository->create($submittedTopic, $acceptedCourse);
        $originalTopic->submissionProcessDone();

        try {
            $acceptedTopicRepository->save($acceptedTopic);
            $originalTopicRepository->save($originalTopic);
            $submittedTopicRepository->delete($submittedTopic);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membuat topik '. $submittedTopic->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $submittedMaterials = $submittedMaterialRepository->findByTopic($submittedTopic);
        foreach ($submittedMaterials as $submittedMaterial) {
            $useCaseRequest->acceptedTopic = $acceptedTopic;
            $useCaseRequest->submittedMaterial = $submittedMaterial;
            if (!$submittedMaterial->instance->isDeleted()){
                $useCase = new CreateMaterialUseCase();
                $response = $useCase->execute($useCaseRequest);

                if ($response->hasError())return $response;
            } else {
                $useCase = new DeleteMaterialUseCase();
                $response = $useCase->execute($useCaseRequest);

                if ($response->hasError())return $response;
            }
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
