<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class CreateMaterialUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalMaterialRepository = $useCaseRequest->originalMaterialRepository;
        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;
        $acceptedMaterialRepository = $useCaseRequest->acceptedMaterialRepository;

        $acceptedTopic = $useCaseRequest->acceptedTopic;
        $submittedMaterial = $useCaseRequest->submittedMaterial;
        $originalMaterial = $submittedMaterial->original();

        $acceptedMaterial = $acceptedMaterialRepository->create($submittedMaterial, $acceptedTopic);
        $originalMaterial->submissionProcessDone();

        try {
            $acceptedMaterialRepository->save($acceptedMaterial);
            $originalMaterialRepository->save($originalMaterial);
            $submittedMaterialRepository->delete($submittedMaterial);
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membuat materi '. $submittedMaterial->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
