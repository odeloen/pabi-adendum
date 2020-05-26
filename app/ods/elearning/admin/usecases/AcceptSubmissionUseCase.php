<?php

namespace App\Ods\Elearning\Admin\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Admin\Usecases\Children\CreateCourseUseCase;
use App\Ods\Elearning\Admin\Usecases\Children\DeleteCourseUseCase;
use App\Ods\Elearning\Core\Entities\Quizzes\AcceptedQuiz;
use App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz;
use Illuminate\Support\Facades\DB;
use App\Ods\Notification\Usecases\CreateNotificationUseCase;

class AcceptSubmissionUseCase
{
    public function execute($useCaseRequest): UseCaseResponse
    {
        $lecturerRepository = $useCaseRequest->lecturerRepository;

        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;

        $acceptedCourseRepository = $useCaseRequest->acceptedCourseRepository;
        $acceptedTopicRepository = $useCaseRequest->acceptedTopicRepository;
        $acceptedMaterialRepository = $useCaseRequest->acceptedMaterialRepository;

        $submittedCourseID = $useCaseRequest->userRequest->submitted_course_id;
        $submittedCourse = $submittedCourseRepository->find($submittedCourseID);
        $originalCourse = $submittedCourse->original();

        DB::connection('odssql')->beginTransaction();

        // Purge accepted course's content

        if ($originalCourse->hasAccepted()) {
            // dd("gege");
            $acceptedCourse = $originalCourse->getAccepted();

            $categories = $acceptedCourse->instance->categories;
            // Purge course categories
            foreach ($categories as $category) {
                try {
                    $category->delete();
                } catch (\Throwable $th) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan materi), silahkan coba beberapa saat lagi');
                    return $response;
                }

            }

            $acceptedTopics = $acceptedTopicRepository->findByCourse($acceptedCourse);
            foreach ($acceptedTopics as $acceptedTopic) {
                $acceptedMaterials = $acceptedMaterialRepository->findByTopic($acceptedTopic);
                foreach ($acceptedMaterials as $acceptedMaterial) {
                    try {
                        $acceptedMaterialRepository->delete($acceptedMaterial);
                    } catch (\Throwable $th) {
                        DB::connection('odssql')->rollBack();
                        $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan materi), silahkan coba beberapa saat lagi');
                        return $response;
                    }
                }

                try {
                    $acceptedTopicRepository->delete($acceptedTopic);
                } catch (\Throwable $th) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan topik), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }

            $acceptedQuiz = AcceptedQuiz::findByCourseID($acceptedCourse->instance->id);

            if (isset($acceptedQuiz)) {
                $acceptedQuestions = $acceptedQuiz->questions;
                
                foreach ($acceptedQuestions as $acceptedQuestion) {
                    try {
                        $acceptedQuestion->delete();
                    } catch (\Exception $e) {
                        DB::connection('odssql')->rollBack();
                        $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan pertanyaan), silahkan coba beberapa saat lagi');
                        return $response;
                    }
                }

                try {
                    $acceptedQuiz->delete();
                } catch (\Exception $e) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan kuis), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }
        }

        // Execute
        $useCaseRequest->submittedCourse = $submittedCourse;
        if (!$submittedCourse->instance->isDeleted()) {
            $useCase = new CreateCourseUseCase();
            $response = $useCase->execute($useCaseRequest);

            if ($response->hasError()) return $response;
        } else {
            $useCase = new DeleteCourseUseCase();
            $response = $useCase->execute($useCaseRequest);

            if ($response->hasError()) return $response;
        }

        $submittedCourse->setAccepted();
        $originalCourse->releaseLock();

        try {
            $submittedCourseRepository->save($submittedCourse);
            $originalCourse->instance->save();
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan (membersihkan materi), silahkan coba beberapa saat lagi');
            return $response;
        }

        try {
            $createNotif = new CreateNotificationUseCase();
            $createNotif->execute($submittedCourse->instance->lecturer_id, "Pengajuan kelas diterima", "Pengajuan kelas \"" . $submittedCourse->instance->name . "\" telah diterima");
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal menerima pengajuan');
            return $response;
        }
        DB::connection('odssql')->commit();

        $response = UseCaseResponse::createMessageResponse('Berhasil menerima pengajuan');

        return $response;
    }
}
