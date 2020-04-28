<?php

namespace App\Ods\Elearning\Lecturer\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Lecturer\Repositories\CategoryRepository;
use App\Ods\Elearning\Lecturer\Repositories\LecturerRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Lecturer\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Lecturer\Usecases\CreateCourseUseCase;
use App\Ods\Elearning\Lecturer\Usecases\GetCourseDetailUseCase;
use App\Ods\Elearning\Lecturer\Usecases\GetCourseListUseCase;
use App\Ods\Elearning\Lecturer\Usecases\UpdateCourseUseCase;
use App\Ods\Elearning\Lecutrer\Usecases\DeleteCourseUseCase;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function list(){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();
        $categoryRepository = new CategoryRepository();

        $useCaseRequest = new UseCaseRequest();
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;
        $useCaseRequest->categoryRepository = $categoryRepository;

        $useCase = new GetCourseListUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return view('Ods\Elearning\Lecturer::courses.list', $response->data);
    }

    public function show($courseID){
        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();
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

        return view('Ods\Elearning\Lecturer::courses.show', $response->data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        if ($request->has('image')){
            $validator = Validator::make($request->all(),[
                'image' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Format gambar yang diterima : jpeg, png, jpg");
                return back()->withErrors($validator)->withInput();
            }
        }

        $lecturerRepository = new LecturerRepository();
        $courseRepository = new OriginalCourseRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->lecturerRepository = $lecturerRepository;
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new CreateCourseUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        if ($request->has('image')){
            $validator = Validator::make($request->all(),[
                'image' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Format gambar yang diterima : jpeg, png, jpg");
                return back()->withErrors($validator)->withInput();
            }
        }

        $courseRepository = new OriginalCourseRepository();

        $useCaseRequest = new UseCaseRequest($request);
        $useCaseRequest->courseRepository = $courseRepository;

        $useCase = new UpdateCourseUseCase();
        $response = $useCase->execute($useCaseRequest);

        Alert::fromResponse($response);

        return back();
    }

    public function delete(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseID = $request->course_id;

        $useCase = new DeleteCourseUseCase(new OriginalCourseRepository);
        $response = $useCase->execute($courseID);

        Alert::fromResponse($response);
        $data = $response->data;
        if ($response->hasError()){
            return back();
        } else if ($data['to'] === 'list') {
            return redirect()->route('lecturer.course.list');
        } else if ($data['to'] === 'submission') {
            return redirect()->route('lecturer.submission.list', $courseID);
        }
    }
}
