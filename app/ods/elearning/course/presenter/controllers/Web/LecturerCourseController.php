<?php

namespace App\Ods\Elearning\Course\Presenter\Controllers\Web;

use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Course\Domain\Usecases\CreateCourseUsecase;
use App\Ods\Elearning\Course\Domain\Usecases\CreateCourseUsecaseRequest;
use App\Ods\Elearning\Course\Domain\Usecases\UpdateCourseUsecase;
use App\Ods\Elearning\Course\Domain\Usecases\UpdateCourseUsecaseRequest;
use App\Ods\Elearning\Course\Infrastructure\Repositories\OriginalCourseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LecturerCourseController extends Controller
{
    public function list(){
//      Todo: Implementing lecturer course list
    }

    public function show(){
//        Todo: Implementing course detail
    }

    public function submissionList($courseID){
//        TODO: Implementing course submission list
    }

    public function submissionShow($submissionID){
//        Todo: Implementing course submission detail
    }

    public function submit(Request $request){
//        TODO: Implementing course submit
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $lecturerRepository = new MemberRepository();
        $courseRepository = new OriginalCourseRepository();

        $lecturer = $lecturerRepository->findAuthenticated();

        $name = $request->name;
        $description = $request->description;
        $image = $request->image;

        $usecase = new CreateCourseUsecase($courseRepository);

        DB::beginTransaction();
        try {
            $response = $usecase->execute(new CreateCourseUsecaseRequest($lecturer, $name, $description, $image));
            Alert::success("Success", $response->getMessage());
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error("Error", $exception->getMessage());
        }
        DB::commit();

        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'id' =>'required',
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

        $courseID = $request->id;
        $name = $request->name;
        $description = $request->description;
        $image = $request->image;

        $usecase = new UpdateCourseUsecase($courseRepository);

        DB::beginTransaction();
        try {
            $response = $usecase->execute(new UpdateCourseUsecaseRequest($courseID, $name, $description, $image));
            Alert::success("Success", $response->getMessage());
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error("Error", $exception->getMessage());
        }
        DB::commit();

        return back();
    }

    public function delete(Request $request){

    }
}
