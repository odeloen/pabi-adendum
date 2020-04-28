<?php

namespace App\Ods\Elearning\Member\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Member\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedTopicRepository;
use App\Ods\Elearning\Lecturer\Repositories\CategoryRepository;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Member\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Member\Repositories\FollowerRepository;

use App\Ods\Elearning\Member\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Member\Usecases\FollowCourseUseCase;
use App\Ods\Elearning\Member\Usecases\GetCourseDetailUseCase;
use App\Ods\Elearning\Member\Usecases\GetFollowedCourseListUseCase;
use App\Ods\Elearning\Member\Usecases\UnfollowCourseUseCase;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct()
    {

    }

    public function search()
    {
        $memberRepository = new MemberRepository;
        $member = $memberRepository->findAuthenticated();

        $useCase = new GetFollowedCourseListUseCase(new AcceptedCourseRepository, new LecturerRepository);
        $response = $useCase->execute($member);
        // dd($response);
        Alert::fromResponse($response);

        return view('Ods\Elearning\Member::course.search', $response->data);
    }

    public function list()
    {
        $memberRepository = new MemberRepository;
        $member = $memberRepository->findAuthenticated();

        $useCase = new GetFollowedCourseListUseCase(new AcceptedCourseRepository, new LecturerRepository);
        $response = $useCase->execute($member);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Member::course.list', $response->data);
    }

    public function show($courseID)
    {
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new AcceptedCourseRepository();
        $topicRepository = new AcceptedTopicRepository();
        $materialRepository = new AcceptedMaterialRepository();
        $categoryRepository = new CategoryRepository();

        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->topicRepository = $topicRepository;
        $useCaseRequest->materialRepository = $materialRepository;
        $useCaseRequest->categoryRepository = $categoryRepository;
        $useCaseRequest->courseID = $courseID;

        $useCase = new GetCourseDetailUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        // dd($response);

        return view('Ods\Elearning\Member::course.show', $response->data);
    }

    public function follow(Request $request)
    {
        // dd($request);
        $memberRepository = new MemberRepository;
        $member = $memberRepository->findAuthenticated();

        $validator = Validator::make($request->all(), [
            'course_id' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseID = $request->course_id;

        $useCase = new FollowCourseUseCase(new AcceptedCourseRepository, new FollowerRepository);

        $response = $useCase->execute($courseID, $member);

        Alert::fromResponse($response);

        return redirect()->route('member.course.show', $request->course_id);
    }

    public function unfollow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $memberRepository = new MemberRepository;
        $member = $memberRepository->findAuthenticated();
        $request->member = $member;
        $useCaseRequest = new UseCaseRequest($request);

        $useCase = new UnfollowCourseUseCase(new AcceptedCourseRepository, new FollowerRepository);
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('member.course.list');
    }
}
