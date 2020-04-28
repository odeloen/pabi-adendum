<?php

namespace App\Ods\Elearning\Lecutrer\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Lecturer\Repositories\CategoryRepository;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedTopicRepository;
use App\Ods\Elearning\Lecturer\Usecases\SubmitCourseUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteCourseUseCase
{
    private $courseRepository;

    public function __construct($courseRepository)
    {
        $this->courseRepository = $courseRepository;

        $this->lecturerRepository = new LecturerRepository();

        $this->originalCourseRepository = new OriginalCourseRepository();
        $this->originalTopicRepository = new OriginalTopicRepository();
        $this->originalMaterialRepository = new OriginalMaterialRepository();

        $this->submittedCourseRepository = new SubmittedCourseRepository();
        $this->submittedTopicRepository = new SubmittedTopicRepository();
        $this->submittedMaterialRepository = new SubmittedMaterialRepository();

        $this->categoryRepository = new CategoryRepository();
    }

    public function execute($courseID) : UseCaseResponse
    {
        $course = $this->courseRepository->find($courseID);

        if ($course->isLocked()){
            $response = UseCaseResponse::createErrorResponse('Kelas ini dalam proses verifikasi');
            return $response;
        }

        $course->setLock();

        if ($course->delete()) {
            $this->courseRepository->save($course);
            $this->courseRepository->delete($course);

            $data = [
                'to' => 'list'
            ];
        } else {
            $this->courseRepository->save($course);

            $request = new Request();
            $request->course_id = $courseID;
            $request->summary = "Menutup kelas";

            $useCaseRequest = new UseCaseRequest($request);

            $useCaseRequest->lecturerRepository = $this->lecturerRepository;

            $useCaseRequest->originalCourseRepository = $this->originalCourseRepository;
            $useCaseRequest->originalTopicRepository = $this->originalTopicRepository;
            $useCaseRequest->originalMaterialRepository = $this->originalMaterialRepository;

            $useCaseRequest->submittedCourseRepository = $this->submittedCourseRepository;
            $useCaseRequest->submittedTopicRepository = $this->submittedTopicRepository;
            $useCaseRequest->submittedMaterialRepository = $this->submittedMaterialRepository;

            $useCase = new SubmitCourseUseCase();
            $response = $useCase->execute($useCaseRequest);

            if ($response->hasError()){
                throw new Exception();
            }

            $data = [
                'to' => 'submission'
            ];
        }

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal menghapus kelas');
            return $response;
        }

        $response = new UseCaseResponse($data, 'Berhasil menghapus kelas', null);

        return $response;
    }
}
