<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class DeleteTopicUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalTopicRepository = $useCaseRequest->originalTopicRepository;
        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;

        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;

        $submittedTopic = $useCaseRequest->submittedTopic;
        $originalTopic = $submittedTopic->original();

        $originalTopic->submissionProcessDone();
        try {
            $originalTopicRepository->save($originalTopic);
            $originalTopicRepository->delete($originalTopic);
            $submittedTopicRepository->delete($submittedTopic);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (menghapus topik'. $submittedTopic->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $submittedMaterials = $submittedMaterialRepository->findByTopic($submittedTopic);
        foreach ($submittedMaterials as $submittedMaterial) {
            $useCaseRequest->submittedMaterial = $submittedMaterial;
            $useCase = new DeleteMaterialUseCase();
            $response = $useCase->execute($useCaseRequest);

            if ($response->hasError())return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
