<?php


namespace App\Ods\Elearning\Course\Presenter\Controllers\Web\Lecturer;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Course\Constant\MaterialType;
use App\Ods\Elearning\Course\Domain\Application\Material\CreateMaterialUsecase;
use App\Ods\Elearning\Course\Domain\Application\Material\GetMaterialDetailUsecase;
use App\Ods\Elearning\Course\Domain\Application\Material\UpdateMaterialUsecase;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Api\Kodig\LecturerRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Course\Presenter\Models\MaterialDetailViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    private $courseRepository;
    private $topicRepository;
    private $materialRepository;
    private $lecturerRepository;

    public function __construct()
    {
        $this->materialRepository = new OriginalMaterialRepository();
        $this->topicRepository = new OriginalTopicRepository($this->materialRepository);
        $this->lecturerRepository = new LecturerRepository();
        $this->courseRepository = new OriginalCourseRepository(
            $this->topicRepository,
            $this->lecturerRepository
        );
    }

    public function show($courseID, $topicID, $materialID){
        $usecase = new GetMaterialDetailUsecase($this->courseRepository);
        $response = $usecase->execute($courseID, $topicID, $materialID);

        if ($response->hasError()) return back();

        $materialDetailViewModel = new MaterialDetailViewModel($response->data);

        return view('Ods\Elearning\Lecturer::material.show')->with('data', $materialDetailViewModel);
    }

    public function createPage($courseID, $topicID){
        $usecase = new GetMaterialDetailUsecase($this->courseRepository);
        $response = $usecase->execute($courseID, $topicID);

        if ($response->hasError()) return back();

        $materialDetailViewModel = new MaterialDetailViewModel($response->data);

        return view('Ods\Elearning\Lecturer::material.create')->with('data', $materialDetailViewModel);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'topic_id' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $topicID = $request->topic_id;
        $name = $request->name;
        $type = $request->type;

        if ($request->has('public_checked')) $public = true;
        else $public = false;

        $content = null;
        if ($type == MaterialType::Post){
            $validator = Validator::make($request->all(),[
                'post_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content = $request->post_content;
            $description = null;
        } else if ($type == MaterialType::File) {
            $validator = Validator::make($request->all(),[
                'file_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content = $request->file('file_content');
            $description = $request->file_description;
        } else if ($type == MaterialType::Video) {
            $validator = Validator::make($request->all(),[
                'video_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content = $request->video_content;
            $description = $request->video_description;
        }

        $usecase = new CreateMaterialUsecase($this->materialRepository);
        $response = $usecase->execute(
            $topicID,
            $name,
            $description,
            $type,
            $content,
            $public
        );

        Alert::fromResponse($response);

        return redirect()->route('elearning.lecturer.course.show', $request->course_id);
    }

    public function updatePage($courseID, $topicID, $materialID){
        $usecase = new GetMaterialDetailUsecase($this->courseRepository);
        $response = $usecase->execute($courseID, $topicID, $materialID);

        Alert::fromResponse($response);
        if ($response->hasError()) return back();

        $materialDetailViewModel = new MaterialDetailViewModel($response->data);

        return view('Ods\Elearning\Lecturer::material.edit')->with('data', $materialDetailViewModel);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'material_id' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $materialID = $request->material_id;
        $name = $request->name;
        $type = $request->type;

        if ($request->has('public_checked')) $public = true;
        else $public = false;

        $content = null;
        $description = null;
        if ($type == MaterialType::Post){
            $validator = Validator::make($request->all(),[
                'post_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content['post_content'] = $request->post_content;
        } else if ($type == MaterialType::File) {
            $validator = Validator::make($request->all(),[
                'file_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content['file_content'] = $request->file('file_content');
            $description = $request->file_description;
        } else if ($type == MaterialType::Video) {
            $validator = Validator::make($request->all(),[
                'video_content' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Isian kurang lengkap");
                return back()->withErrors($validator)->withInput();
            }

            $content['video_content'] = $request->video_content;
            $description = $request->video_description;
        }

        $usecase = new UpdateMaterialUsecase($this->materialRepository);
        $response = $usecase->execute(
            $materialID,
            $name,
            $description,
            $public,
            $content
        );

        Alert::fromResponse($response);

        return redirect()->route('elearning.lecturer.course.show', $request->course_id);
    }

    public function delete(Request $request){
        // todo : implement delete method
    }
}
