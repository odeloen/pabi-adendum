<?php


namespace App\Ods\Elearning\Course\Presenter\Controllers\Web\Lecturer;


use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Elearning\Course\Domain\Application\Topic\CreateTopicUsecase;
use App\Ods\Elearning\Course\Domain\Application\Topic\DeleteTopicUsecase;
use App\Ods\Elearning\Course\Domain\Application\Topic\UpdateTopicUsecase;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;
use App\Ods\Elearning\Course\Infrastructure\Persistence\Eloquent\Repositories\OriginalTopicRepository;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * @var ITopicRepository
     */
    private $topicRepository;

    public function __construct()
    {
        $this->topicRepository = new OriginalTopicRepository();
    }

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

        $courseID = $request->course_id;
        $name = $request->name;
        $description = $request->description;

        $usecase = new CreateTopicUsecase($this->topicRepository);
        $response = $usecase->execute(
            $courseID,
            $name,
            $description
        );

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

        $topicID = $request->topic_id;
        $name = $request->name;
        $description = $request->description;

        $usecase = new UpdateTopicUsecase($this->topicRepository);
        $response = $usecase->execute(
            $topicID,
            $name,
            $description
        );

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

        $topicID = $request->topic_id;

        $usecase = new DeleteTopicUsecase($this->topicRepository);
        $response = $usecase->execute(
            $topicID
        );

        Alert::fromResponse($response);

        return back();
    }
}
