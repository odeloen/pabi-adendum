<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class CreateMaterialUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $materialRepository = $useCaseRequest->materialRepository;
        $courseRepository = $useCaseRequest->courseRepository;

        $topicID = $useCaseRequest->userRequest->topic_id;
        $name = $useCaseRequest->userRequest->name;
        $type = $useCaseRequest->userRequest->type;
        $content = $useCaseRequest->userRequest->content;
        $description = $useCaseRequest->userRequest->description;

        // dd($topicID);

        if (!empty($content['file'])){
            $content['file'] = $useCaseRequest->userRequest->file('content.file');
        }

        $material = $materialRepository->create($topicID, $name, $type, $content,$description);

        if ($useCaseRequest->userRequest->has('public_checked')){
            $publicChecked = $useCaseRequest->userRequest->public_checked;
            if ($publicChecked) $publicChecked = true;
            else $publicChecked = false;
            $material->instance->setPublicModifier($publicChecked);
        }

        $course = $courseRepository->findByMaterial($material);
        $course->instance->setUpdated();

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        DB::beginTransaction();
        try {
            $materialRepository->save($material);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat materi');
            return $response;
        }
        DB::commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat materi');

        return $response;
    }
}
