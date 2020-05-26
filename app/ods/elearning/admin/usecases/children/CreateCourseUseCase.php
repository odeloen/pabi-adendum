<?php

namespace App\Ods\Elearning\Admin\Usecases\Children;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Core\Entities\Questions\AcceptedQuestion;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;
use App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz;
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
            DB::connection('odssql')->rollBack();
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

        $submittedQuiz = SubmittedQuiz::findByCourseID($submittedCourse->instance->id);

        if (isset($submittedQuiz)) {

            try {
                $acceptedQuiz = AcceptedQuiz::create($submittedQuiz, $acceptedCourse->instance->id);
            } catch (\Exception $e) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membuat kuis '. $submittedCourse->instance->name .'), silahkan coba beberapa saat lagi');
                return $response;
            }

            $submittedQuestions = $submittedQuiz->questions;
            foreach ($submittedQuestions as $submittedQuestion) {
                try {
                    $acceptedQuestion = AcceptedQuestion::create($submittedQuestion, $acceptedQuiz->id);
                } catch (\Exception $e) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membuat pertanyaan '. $submittedQuestion->no .'), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }
        }

        $response = UseCaseResponse::createMessageResponse('Berhasil');

        return $response;
    }
}
