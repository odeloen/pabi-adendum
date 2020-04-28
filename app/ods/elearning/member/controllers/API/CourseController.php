<?php

namespace App\Ods\Elearning\Member\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedTopicRepository;
use App\Ods\Elearning\Lecturer\Repositories\CategoryRepository;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Member\Repositories\FollowerRepository;

use App\Ods\Elearning\Member\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Member\Usecases\SearchCourseUseCase;
use App\Ods\Elearning\Member\Usecases\FollowCourseUseCase;
use App\Ods\Elearning\Member\Usecases\GetCourseDetailUseCase;
use App\Ods\Elearning\Member\Usecases\GetFollowedCourseListUseCase;
use App\Ods\Elearning\Member\Usecases\UnfollowCourseUseCase;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    private $memberRepository;
    private $lecturerRepository;
    private $courseRepository;
    private $topicRepository;
    private $materialRepository;
    private $categoryRepository;

    public function __construct() {
        $this->memberRepository = new MemberRepository();
        $this->lecturerRepository = new LecturerRepository();
        $this->courseRepository = new AcceptedCourseRepository();
        $this->topicRepository = new AcceptedTopicRepository();
        $this->materialRepository = new AcceptedMaterialRepository();
        $this->categoryRepository = new CategoryRepository();
    } 

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'query' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $query = request('query');

        $useCase = new SearchCourseUseCase($this->courseRepository, $this->lecturerRepository);
        $response = $useCase->execute($query);

        return response()->json($response);
    }

    public function list()
    {
        $member = $this->memberRepository->findAuthenticated();

        $useCase = new GetFollowedCourseListUseCase($this->courseRepository, $this->lecturerRepository);
        $response = $useCase->execute($member);

        return response()->json($response);
    }

    public function show($courseID)
    {
        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $this->lecturerRepository;
        $useCaseRequest->courseRepository = $this->courseRepository;
        $useCaseRequest->topicRepository = $this->topicRepository;
        $useCaseRequest->materialRepository = $this->materialRepository;
        $useCaseRequest->categoryRepository = $this->categoryRepository;
        $useCaseRequest->courseID = $courseID;

        $useCase = new GetCourseDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }

    public function follow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'account_id' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseID = $request->course_id;

        $member = $this->memberRepository->find($request->account_id);
        $useCase = new FollowCourseUseCase($this->courseRepository, new FollowerRepository);
        $response = $useCase->execute($courseID, $member);

        return response()->json($response);
    }

    public function unfollow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'account_id' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }
        $member = $this->memberRepository->find($request->account_id);

        $request->member = $member;
        $useCaseRequest = new UseCaseRequest($request);

        $useCase = new UnfollowCourseUseCase($this->courseRepository, new FollowerRepository);
        $response = $useCase->execute($useCaseRequest);

        return response()->json($response);
    }
}
