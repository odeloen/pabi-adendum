<?php

namespace App\Ods\Elearning\Lecturer\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecturer\Usecases\GetMaterialDetailUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\CreateMaterialUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\DeleteMaterialUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\UpdateMaterialUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function show($courseID, $topicID, $materialID){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;

        $useCaseRequest->userRequest = new Request();
        $useCaseRequest->userRequest->course_id = $courseID;
        $useCaseRequest->userRequest->topic_id = $topicID;
        $useCaseRequest->userRequest->material_id = $materialID;

        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::courses.material.show', $response->data);
    }

    public function createPage($courseID, $topicID){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();

        $request = new Request;
        $request->course_id = $courseID;
        $request->topic_id = $topicID;

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;

        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::courses.material.create', $response->data)->with('courseID', $courseID)->with('topicID', $topicID);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseRepository = new OriginalCourseRepository;
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->materialRepository = $materialRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new CreateMaterialUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);
        return redirect()->route('lecturer.course.show', $request->course_id);
    }

    public function updatePage($courseID, $topicID, $materialID){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;

        $useCaseRequest->userRequest = new Request();
        $useCaseRequest->userRequest->course_id = $courseID;
        $useCaseRequest->userRequest->topic_id = $topicID;
        $useCaseRequest->userRequest->material_id = $materialID;

        $useCase = new GetMaterialDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::courses.material.edit', $response->data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'course_id' => 'required',
            'material_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseRepository = new OriginalCourseRepository;
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->materialRepository = $materialRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new UpdateMaterialUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);
        return redirect()->route('lecturer.course.show', $request->course_id);
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
            'material_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseRepository = new OriginalCourseRepository;
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->materialRepository = $materialRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new DeleteMaterialUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);
        return redirect()->route('lecturer.course.show', $request->course_id);
    }
}
