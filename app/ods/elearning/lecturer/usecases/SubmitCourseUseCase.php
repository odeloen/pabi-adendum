<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Core\Entities\Questions\SubmittedQuestion;
use App\Ods\Elearning\Core\Entities\Quizzes\OriginalQuiz;
use App\Ods\Elearning\Core\Entities\Quizzes\SubmittedQuiz;
use Illuminate\Support\Facades\DB;

class SubmitCourseUseCase
{
    public function execute($useCaseRequest) : UseCaseResponse
    {
        $courseRepository = $useCaseRequest->originalCourseRepository;
        $topicRepository = $useCaseRequest->originalTopicRepository;
        $materialRepository = $useCaseRequest->originalMaterialRepository;

        $submittedCourseRepository = $useCaseRequest->submittedCourseRepository;
        $submittedTopicRepository = $useCaseRequest->submittedTopicRepository;
        $submittedMaterialRepository = $useCaseRequest->submittedMaterialRepository;

        $courseID = $useCaseRequest->userRequest->course_id;
        $summary = $useCaseRequest->userRequest->summary;

        $course = $courseRepository->find($courseID);

        $submittedCourse = $course->makeSubmitCopy();
        $submittedCourse->setSummary($summary);

        DB::connection('odssql')->beginTransaction();
        try {
            $submittedCourseRepository->save($submittedCourse);
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (kelas), silahkan coba beberapa saat lagi');
            return $response;
        }

        $topics = $topicRepository->findByCourse($course);
        foreach ($topics as $topic) {
            $submittedTopic = $topic->makeSubmitCopy($submittedCourse);

            try {
                $submittedTopicRepository->save($submittedTopic);
            } catch (\Throwable $th) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (topik), silahkan coba beberapa saat lagi');
                return $response;
            }

            $materials = $materialRepository->findByTopic($topic);
            foreach ($materials as $material) {
                $submittedMaterial = $material->makeSubmitCopy($submittedTopic);

                try {
                    $submittedMaterialRepository->save($submittedMaterial);
                } catch (\Throwable $th) {
                    DB::connection('odssql')->rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (materi), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }
        }

        $course->setLock();

        try {
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            DB::connection('odssql')->rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (kelas), silahkan coba beberapa saat lagi');
            return $response;
        }

        $originalQuiz = OriginalQuiz::findByCourseID($courseID);

        if (isset($originalQuiz)) {
            if (!$originalQuiz->isValidForSubmit()) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Tolong lengkapi informasi kuis');
                return $response;
            }

            try {
                $submittedQuiz = SubmittedQuiz::create(
                    $originalQuiz,
                    $submittedCourse->instance->id
                );
            } catch (\Exception $e) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (kuis), silahkan coba beberapa saat lagi');
                return $response;
            }


            try {
                foreach ($originalQuiz->questions as $originalQuestion) {
                    $submittedQuestion = SubmittedQuestion::create($originalQuestion, $submittedQuiz->id);
                }
            } catch (\Exception $e) {
                DB::connection('odssql')->rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (pertanyaan), silahkan coba beberapa saat lagi');
                return $response;
            }
        }

        DB::connection('odssql')->commit();
        $response = UseCaseResponse::createMessageResponse('Berhasil membuat pengajuan');

        return $response;
    }
}
