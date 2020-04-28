<?php

namespace App\Ods\Elearning\Admin\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Admin\Repositories\SubmittedCourseRepository;
use App\Ods\Elearning\Admin\Repositories\SubmittedMaterialRepository;
use App\Ods\Elearning\Admin\Repositories\SubmittedTopicRepository;
use App\Ods\Elearning\Admin\Usecases\GetMaterialDetailUseCase;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use Illuminate\Http\Request;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse;

class MaterialController extends Controller
{
    public function show($submissionID, $topicID, $materialID){
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
        // dd($submissionID);
        // dd(SubmittedCourse::find("b553de8f-91eb-4542-a9d5-a87b7e87686a"));
        // dd(SubmittedCourse::find("b553de8f-91eb-4542-a9d5-a87b7e87686a"));
        // dd($courseRepository->find($submissionID));
        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Admin::material.show', $response->data);
    }
}
