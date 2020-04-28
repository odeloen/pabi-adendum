<?php

namespace App\Ods\Elearning\Member\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedTopicRepository;
use App\Ods\Elearning\Member\Usecases\GetMaterialDetailUseCase;

class MaterialController extends Controller
{
    private $lecturerRepository;
    private $courseRepository;
    private $topicRepository;
    private $materialRepository;

    public function __construct() {
        $this->lecturerRepository = new LecturerRepository();
        $this->courseRepository = new AcceptedCourseRepository();
        $this->topicRepository = new AcceptedTopicRepository();
        $this->materialRepository = new AcceptedMaterialRepository();
    }

    public function show($submissionID, $topicID, $materialID)
    {
        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $this->lecturerRepository;
        $useCaseRequest->courseRepository = $this->courseRepository;
        $useCaseRequest->topicRepository = $this->topicRepository;
        $useCaseRequest->materialRepository = $this->materialRepository;

        $useCaseRequest->userRequest = new Request();
        $useCaseRequest->userRequest->course_id = $submissionID;
        $useCaseRequest->userRequest->topic_id = $topicID;
        $useCaseRequest->userRequest->material_id = $materialID;

        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }
}