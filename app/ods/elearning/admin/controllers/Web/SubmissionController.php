<?php

namespace App\Ods\Elearning\Admin\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Admin\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Admin\Repositories\AcceptedMaterialRepository;
use App\Ods\Elearning\Admin\Repositories\AcceptedTopicRepository;
use App\Ods\Elearning\Admin\Repositories\CategoryRepository;
use App\Ods\Elearning\Admin\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Admin\Repositories\SubmittedCourseRepository;
use App\Ods\Elearning\Admin\Repositories\SubmittedMaterialRepository;
use App\Ods\Elearning\Admin\Repositories\SubmittedTopicRepository;
use App\Ods\Elearning\Admin\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Admin\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Admin\Usecases\AcceptSubmissionUseCase;
use App\Ods\Elearning\Admin\Usecases\CreateCommentUseCase;
use App\Ods\Elearning\Admin\Usecases\DeleteCommentUseCase;
use App\Ods\Elearning\Admin\Usecases\GetCourseDetailUseCase;
use App\Ods\Elearning\Admin\Usecases\GetSubmissionListUseCase;
use App\Ods\Elearning\Core\Config\Naming;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Admin\Usecases\DeclineSubmissionUseCase;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    private $lecturerRepository;

    private $categoryRepository;

    private $originalCourseRepository;
    private $originalTopicRepository;
    private $originalMaterialRepository;

    private $submittedCourseRepository;
    private $submittedTopicRepository;
    private $submittedMaterialRepository;

    private $acceptedCourseRepository;
    private $acceptedTopicRepository;
    private $acceptedMaterialRepository;

    public function __construct()
    {
        $this->lecturerRepository = new LecturerRepository();
        $this->categoryRepository = new CategoryRepository();

        $this->originalCourseRepository = new OriginalCourseRepository();
        $this->originalTopicRepository = new OriginalTopicRepository();
        $this->originalMaterialRepository = new OriginalMaterialRepository();

        $this->submittedCourseRepository = new SubmittedCourseRepository();
        $this->submittedTopicRepository = new SubmittedTopicRepository();
        $this->submittedMaterialRepository = new SubmittedMaterialRepository();

        $this->acceptedCourseRepository = new AcceptedCourseRepository();
        $this->acceptedTopicRepository = new AcceptedTopicRepository();
        $this->acceptedMaterialRepository = new AcceptedMaterialRepository();
    }

    public function list()
    {
        // $useCaseRequest = new UseCaseRequest();
        // $useCaseRequest->submittedCourseRepository = $this->submittedCourseRepository;

        $useCase = new GetSubmissionListUseCase($this->submittedCourseRepository, $this->lecturerRepository);

        $response = $useCase->execute();

        Alert::fromResponse($response);

        return view('Ods\Elearning\Admin::submission.list', $response->data);
    }

    public function show($submissionID)
    {
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

        return view('Ods\Elearning\Admin::submission.show', $response->data);
    }

    public function createComment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'submitted_course_id' => 'required',
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $commentableRepository = Naming::getAdminNamespace().'Repositories\\'.$request->commentable_type.'Repository';

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->commentableRepository = new $commentableRepository();

        $useCase = new CreateCommentUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('admin.submission.show', $request->submitted_course_id);
    }

    public function deleteComment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'submitted_course_id' => 'required',
            'commentable_type' => 'required',
            'commentable_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $commentableRepository = Naming::getAdminNamespace().'Repositories\\'.$request->commentable_type.'Repository';

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->commentableRepository = new $commentableRepository();

        $useCase = new DeleteCommentUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('admin.submission.show', $request->submitted_course_id);
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'submitted_course_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->lecturerRepository = new LecturerRepository();
        $useCaseRequest->originalCourseRepository = new OriginalCourseRepository();
        $useCaseRequest->originalTopicRepository = new OriginalTopicRepository();
        $useCaseRequest->originalMaterialRepository = new OriginalMaterialRepository();

        $useCaseRequest->submittedCourseRepository = new SubmittedCourseRepository();
        $useCaseRequest->submittedTopicRepository = new SubmittedTopicRepository();
        $useCaseRequest->submittedMaterialRepository = new SubmittedMaterialRepository();

        $useCaseRequest->acceptedCourseRepository = new AcceptedCourseRepository();
        $useCaseRequest->acceptedTopicRepository = new AcceptedTopicRepository();
        $useCaseRequest->acceptedMaterialRepository = new AcceptedMaterialRepository();

        $useCase = new AcceptSubmissionUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('admin.submission.list');
    }

    public function decline(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'submitted_course_id' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $useCaseRequest = new UseCaseRequest($request);

        $useCaseRequest->submittedCourseRepository = new SubmittedCourseRepository();
        $useCaseRequest->submittedTopicRepository = new SubmittedTopicRepository();
        $useCaseRequest->submittedMaterialRepository = new SubmittedMaterialRepository();

        $useCase = new DeclineSubmissionUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return redirect()->route('admin.submission.list');
    }
}
