<?php

namespace App\Ods\Elearning\Lecturer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
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

        DB::beginTransaction();

        try {
            $submittedCourseRepository->save($submittedCourse);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (kelas), silahkan coba beberapa saat lagi');
            return $response;
        }

        $topics = $topicRepository->findByCourse($course);
        foreach ($topics as $topic) {
            $submittedTopic = $topic->makeSubmitCopy($submittedCourse);
            // dd($submittedTopic);
            try {
                $submittedTopicRepository->save($submittedTopic);
            } catch (\Throwable $th) {
                DB::rollBack();
                $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (topik), silahkan coba beberapa saat lagi');
                return $response;
            }

            $materials = $materialRepository->findByTopic($topic);
            foreach ($materials as $material) {
                $submittedMaterial = $material->makeSubmitCopy($submittedTopic);

                try {
                    $submittedMaterialRepository->save($submittedMaterial);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (materi), silahkan coba beberapa saat lagi');
                    return $response;
                }
            }
        }

        $course->setLock();

        try {
            $courseRepository->save($course);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = UseCaseResponse::createErrorResponse('Gagal membuat pengajuan (kelas), silahkan coba beberapa saat lagi');
            return $response;
        }

        DB::commit();
        $response = UseCaseResponse::createMessageResponse('Berhasil membuat pengajuan');

        return $response;
    }
}
