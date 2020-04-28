<?php

namespace App\Ods\Elearning\Lecturer\Controllers\API;

use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecutrer\Usecases\CreateTopicUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\DeleteTopicUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\UpdateTopicUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function create(Request $request){

    }

    public function update(Request $request){

    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 409);
        }

        $topicRepository = new OriginalTopicRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->topicRepository = $topicRepository;

        $useCase = new DeleteTopicUseCase();
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }
}
