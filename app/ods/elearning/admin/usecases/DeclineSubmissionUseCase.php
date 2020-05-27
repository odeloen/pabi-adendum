<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;
use App\Ods\Notification\Usecases\CreateNotificationUseCase;

class DeclineSubmissionUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;
        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;
        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;

        $submittedCourseID = $useCaseRequest->userRequest->submitted_course_id;
        $comment = $useCaseRequest->userRequest->comment;

        $submittedCourse = $submittedCourseRepository->find($submittedCourseID);

        $submittedCourse->setDeclined($comment);
        $originalCourse = $submittedCourse->original();
        $originalCourse->releaseLock();

        DB::connection('odssql')->beginTransaction();
        try {
            $submittedCourseRepository->save($submittedCourse);
            $submittedCourseRepository->delete($submittedCourse);
            $originalCourse->instance->save();
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menolak pengajuan (kelas), silahkan coba beberapa saat lagi');
            return $response;
        }

        $submittedTopics = $submittedTopicRepository->findByCourse($submittedCourse);
        foreach($submittedTopics as $submittedTopic){

            try {
                $submittedTopicRepository->delete($submittedTopic);
            } catch (\Throwable $th) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal menolak pengajuan (topik), silahkan coba beberapa saat lagi');
                return $response;
            }

            $submittedMaterials = $submittedMaterialRepository->findByTopic($submittedTopic);
            foreach($submittedMaterials as $submittedMaterial){

                try {
                    $submittedMaterialRepository->delete($submittedMaterial);
                } catch (\Throwable $th) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal menolak pengajuan (material), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }
        }

        try {
            $createNotif = new CreateNotificationUseCase();
            $createNotif->execute($submittedCourse->instance->lecturer_id, "Pengajuan kelas ditolak", "Pengajuan kelas \"".$submittedCourse->instance->name."\" telah ditolak");
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat notifikasi');
            return $response;
        }
        DB::connection('odssql')->commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil membuat pengajuan');

        return $response;
    }
}
