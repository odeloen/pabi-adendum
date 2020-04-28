<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class DeleteMaterialUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->courseRepository;
        $materialRepository = $useCaseRequest->materialRepository;

        $materialID = $useCaseRequest->userRequest->material_id;

        try {
            $material = $materialRepository->find($materialID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menemukan materi');
            return $response;
        }

        $course = $courseRepository->findByMaterial($material);
        $course->instance->setUpdated();

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        DB::beginTransaction();
        try {
            if ($material->delete()) $materialRepository->delete($material);
            
            $materialRepository->save($material);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menghapus materi');
            return $response;
        }
        DB::commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menghapus materi');

        return $response;
    }
}
