<?php

namespace App\Ods\Elearning\Lecturer\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecutrer\Usecases\CreateTopicUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\DeleteTopicUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\UpdateTopicUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $topicRepository = new OriginalTopicRepository();
        $courseRepository = new OriginalCourseRepository;

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new CreateTopicUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'topic_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseRepository = new OriginalCourseRepository;
        $topicRepository = new OriginalTopicRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new UpdateTopicUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'topic_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseRepository = new OriginalCourseRepository;
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;

        $useCase = new DeleteTopicUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }
}
