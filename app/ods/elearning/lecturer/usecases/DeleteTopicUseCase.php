<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class DeleteTopicUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->courseRepository;
        $topicRepository = $useCaseRequest->topicRepository;
        $materialRepository = $useCaseRequest->materialRepository;

        $topicID = $useCaseRequest->userRequest->topic_id;

        try {
            $topic = $topicRepository->find($topicID);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menemukan topik terkait');
            return $response;
        }

        try {
            $materials = $materialRepository->findByTopic($topic);
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menemukan materi terkait topik');
            return $response;
        }

        $course = $courseRepository->findByTopic($topic);
        $course->instance->setUpdated();

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }        

        DB::beginTransaction();
        try {
            if ($materials != null){
                foreach ($materials as $material) {
                    if ($material->delete()) $materialRepository->delete($material);
                    $materialRepository->save($material);
                }
            }
            if ($topic->delete()) $topicRepository->delete($topic);
            
            $topicRepository->save($topic);
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menghapus topik');
            return $response;
        }
        DB::commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menghapus topik');

        return $response;
    }
}
