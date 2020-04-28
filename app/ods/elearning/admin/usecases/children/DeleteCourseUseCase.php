<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class DeleteCourseUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalCourseRepository = $useCaseRequest->originalCourseRepository;
        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;

        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;

        $submittedCourse = $useCaseRequest->submittedCourse;
        $originalCourse = $submittedCourse->original();
        $acceptedCourse = $originalCourse->getAccepted();

        $originalCourse->submissionProcessDone();
        try {
            $originalCourseRepository->save($originalCourse);
            $originalCourseRepository->delete($originalCourse);
            $submittedCourseRepository->delete($submittedCourse);
            $acceptedCourse->instance->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (menghapus kelas '. $submittedCourse->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $submittedTopics = $submittedTopicRepository->findByCourse($submittedCourse);
        foreach ($submittedTopics as $submittedTopic) {
            $useCaseRequest->submittedTopic = $submittedTopic;
            $useCase = new DeleteTopicUseCase();
            $response = $useCase->execute($useCaseRequest);

            if ($response->hasError())return $response;
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
