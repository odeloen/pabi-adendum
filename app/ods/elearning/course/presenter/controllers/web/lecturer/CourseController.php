<?php


namespace App\Ods\Elearning\Course\Presenter\Controllers\Web\Lecturer;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Course\Domain\Application\Course\CreateCourseUsecase;
use App\Ods\Elearning\Course\Domain\Application\Course\DeleteCourseUsecase;
use App\Ods\Elearning\Course\Domain\Application\Course\GetCourseListByLecturerUsecase;
use App\Ods\Elearning\Course\Domain\Application\Course\UpdateCourseUsecase;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Api\Kodig\LecturerRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalCourseRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalMaterialRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalTopicRepository;
use App\Ods\Elearning\Course\Presenter\Models\CourseViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    public function __construct()
    {
        $topicRepository = new OriginalTopicRepository();
        $materialRepository = new OriginalMaterialRepository();
        $lecturerRepository = new LecturerRepository();

        $this->courseRepository = new OriginalCourseRepository(
            $topicRepository,
            $materialRepository,
            $lecturerRepository
        );
    }

    private function getAuthenticatedLecturer(){
        $lecturerRepository = $this->courseRepository->getLecturerRepository();
        $lecturerID = session()->get('pabi_user_id');
        $lecturer = $lecturerRepository->findByID($lecturerID);

        return $lecturer;
    }

    public function list(){
        $lecturer = $this->getAuthenticatedLecturer();

        $usecase = new GetCourseListByLecturerUsecase($this->courseRepository);
        $response = $usecase->execute($lecturer);

        if (!empty($response->data)){
            $res = [];
            foreach ($response->data['courses'] as $courseDomainModel){
                $courseViewModel = new CourseViewModel($courseDomainModel);
                $res[] = $courseViewModel;
            }
            $response->data['courses'] = collect($res);
        }

        return view('Ods\Elearning::course.list', $response->data);
    }

    public function show(){
        // todo : implement show method
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

        $name = $request->name;
        $description = $request->description;
        $image = null;
        if ($request->has('image')){
            $validator = Validator::make($request->all(),[
                'image' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Format gambar yang diterima : jpeg, png, jpg");
                return back()->withErrors($validator)->withInput();
            }

            $image = $request->file('image');
        }

        $lecturer = $this->getAuthenticatedLecturer();

        $usecase = new CreateCourseUsecase($this->courseRepository);
        $response = $usecase->execute(
            $lecturer,
            $name,
            $description,
            $image
        );

        Alert::fromResponse($response);
        return back();
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseID = $request->course_id;
        $name = $request->name;
        $description = $request->description;
        $image = null;
        if ($request->has('image')){
            $validator = Validator::make($request->all(),[
                'image' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Format gambar yang diterima : jpeg, png, jpg");
                return back()->withErrors($validator)->withInput();
            }

            $image = $request->file('image');
        }

        $usecase = new UpdateCourseUsecase($this->courseRepository);
        $response = $usecase->execute(
            $courseID,
            $name,
            $description,
            $image
        );

        Alert::fromResponse($response);

        return back();
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
        }

        $courseID = $request->course_id;

        $usecase = new DeleteCourseUsecase($this->courseRepository);
        $response = $usecase->execute(
            $courseID,
        );

        Alert::fromResponse($response);

        return back();
    }
}
