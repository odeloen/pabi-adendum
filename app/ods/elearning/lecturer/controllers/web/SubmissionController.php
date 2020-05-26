<?php

namespace App\Ods\Elearning\Lecturer\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\CategoryRepository;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\SubmittedTopicRepository;
use App\Ods\Elearning\Lecturer\Usecases\GetCourseDetailUseCase;
use App\Ods\Elearning\Lecturer\Usecases\GetMaterialDetailUseCase;
use App\Ods\Elearning\Lecturer\Usecases\GetSubmittedCourseListUseCase;
use App\Ods\Elearning\Lecturer\Usecases\SubmitCourseUseCase;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function __construct(){
        $this->lecturerRepository = new LecturerRepository();

        $this->originalCourseRepository = new OriginalCourseRepository();
        $this->originalTopicRepository = new OriginalTopicRepository();
        $this->originalMaterialRepository = new OriginalMaterialRepository();

        $this->submittedCourseRepository = new SubmittedCourseRepository();
        $this->submittedTopicRepository = new SubmittedTopicRepository();
        $this->submittedMaterialRepository = new SubmittedMaterialRepository();

        $this->categoryRepository = new CategoryRepository();
    }

    public function list(string $courseID){
        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $this->lecturerRepository;
        $useCaseRequest->originalCourseRepository = $this->originalCourseRepository;
        $useCaseRequest->submittedCourseRepository = $this->submittedCourseRepository;
        $useCaseRequest->courseID = $courseID;

        $useCase = new GetSubmittedCourseListUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::submission.list', $response->data);
    }

    public function show(string $courseID, string $submissionID){
        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $this->lecturerRepository;
        $useCaseRequest->courseRepository = $this->submittedCourseRepository;
        $useCaseRequest->topicRepository = $this->submittedTopicRepository;
        $useCaseRequest->materialRepository = $this->submittedMaterialRepository;
        $useCaseRequest->categoryRepository = $this->categoryRepository;
        $useCaseRequest->courseID = $submissionID;

        $useCase = new GetCourseDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        // dd($response);

        return view('Ods\Elearning\Lecturer::submission.show', $response->data);
    }

    public function showMaterial($submissionID, $topicID, $materialID){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new SubmittedCourseRepository();
        $topicRepository = new SubmittedTopicRepository();
        $materialRepository = new SubmittedMaterialRepository();

        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;

        $useCaseRequest->userRequest = new Request();
        $useCaseRequest->userRequest->course_id = $submissionID;
        $useCaseRequest->userRequest->topic_id = $topicID;
        $useCaseRequest->userRequest->material_id = $materialID;

        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::submission.material.show', $response->data);
    }

    public function create(Request $request){
        // dd($request);

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

        Alert::fromResponse($response);

        return back();
    }
}
