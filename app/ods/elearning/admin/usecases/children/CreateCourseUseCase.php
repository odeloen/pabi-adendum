<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class CreateCourseUseCase 
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $originalCourseRepository = $useCaseRequest->originalCourseRepository;
        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;
        $acceptedCourseRepository = $useCaseRequest->acceptedCourseRepository;

        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;

        $submittedCourse = $useCaseRequest->submittedCourse;
        $originalCourse = $submittedCourse->original();

        $acceptedCourse = $acceptedCourseRepository->create($submittedCourse);
        $originalCourse->submissionProcessDone();

        $acceptedCourseRepository->save($acceptedCourse);
        $originalCourseRepository->save($originalCourse);

        try {
            $submittedCourseRepository->delete($submittedCourse);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membuat kelas '. $submittedCourse->instance->name .'), silahkan coba beberapa saat lagi');
            return $response;
        }

        $submittedTopics = $submittedTopicRepository->findByCourse($submittedCourse);
        foreach ($submittedTopics as $submittedTopic) {
            $useCaseRequest->acceptedCourse = $acceptedCourse;
            $useCaseRequest->submittedTopic = $submittedTopic;
            if (!$submittedTopic->instance->isDeleted()){
                $useCase = new CreateTopicUseCase();
                $response = $useCase->execute($useCaseRequest);

                if ($response->hasError())return $response;
            } else {
                $useCase = new DeleteTopicUseCase();
                $response = $useCase->execute($useCaseRequest);

                if ($response->hasError())return $response;
            }
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
