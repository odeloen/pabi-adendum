<?php

namespace App\Ods\Elearning\Member\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedTopicRepository;
use App\Ods\Elearning\Member\Repositories\FollowerRepository;
use App\Ods\Elearning\Member\Usecases\GetMaterialDetailUseCase;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function __construct()
    {

    }

    public function show($submissionID, $topicID, $materialID)
    {
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new AcceptedCourseRepository();
        $topicRepository = new AcceptedTopicRepository();
        $materialRepository = new AcceptedMaterialRepository();

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

        return view('Ods\Elearning\Member::material.show', $response->data);
    }
}
