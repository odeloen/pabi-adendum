<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class DeleteMaterialUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalMaterialRepository = $useCaseRequest->originalMaterialRepository;
        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;

        $submittedMaterial = $useCaseRequest->submittedMaterial;
        $originalMaterial = $submittedMaterial->original();

        $originalMaterial->submissionProcessDone();
        try {
            $originalMaterialRepository->save($originalMaterial);
            $originalMaterialRepository->delete($originalMaterial);
            $submittedMaterialRepository->delete($submittedMaterial);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (menghapus materi '. $submittedMaterial->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
