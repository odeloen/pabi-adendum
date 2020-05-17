<?php


namespace App\Ods\Announcement\Presenter\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Ods\Announcement\Domain\Application\CreateAnnouncementUsecase;
use App\Ods\Announcement\Domain\Application\DeleteAnnouncementUsecase;
use App\ods\announcement\domain\application\GetAnnouncementDetailUsecase;
use App\Ods\Announcement\Domain\Application\GetAnnouncementListUsecase;
use App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Repositories\AnnouncementEloquentRepository;
use App\ods\announcement\presenter\models\AnnouncementViewModel;
use App\Ods\Core\Entities\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAnnouncementController extends Controller
{
    private $announcementRepository;

    public function __construct()
    {
        $this->announcementRepository = new AnnouncementEloquentRepository();
    }

    public function list(){
        $usecase = new GetAnnouncementListUsecase($this->announcementRepository);
        $response = $usecase->execute();

        if (!empty($response->data)){
            $res = [];
            foreach ($response->data['announcements'] as $announcementDomainModel){
               $announcementViewModel = new AnnouncementViewModel($announcementDomainModel);
               $res[] = $announcementViewModel;
            }
            $response->data['announcements'] = $res;
        }
        dd($response);
        return view('Ods\Announcement::admin.list', $response->data);
    }

    public function show($announcementID){
        $usecase = new GetAnnouncementDetailUsecase($this->announcementRepository);
        $response = $usecase->execute($announcementID);

        if (!empty($response->data)){
            $announcementViewModel = new AnnouncementViewModel($response->data['announcement']);
            $response->data['announcement'] = $announcementViewModel;
        }
        
        return view('Ods\Announcement::admin.show', $response->data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error("Error", "Isian kurang lengkap");
            return back()->withErrors($validator)->withInput();
            //return response()->json(['errors' => $validator->errors()], 409);
        }

        $title = $request->title;
        $description = $request->description;
        $image = null;

        if ($request->has('image')){
            $validator = Validator::make($request->all(),[
                'image' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                Alert::error("Error", "Format gambar yang diterima : jpeg, png, jpg");
                return back()->withErrors($validator)->withInput();
                //return response()->json(['errors' => $validator->errors()], 409);
            }

            $image = $request->file('image');
        }

        $usecase = new CreateAnnouncementUsecase($this->announcementRepository);
        $response = $usecase->execute($title, $description, $image);

        Alert::fromResponse($response);

        return redirect()->route('admin.announcement.list');
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'announcement_id' => 'required',
        ]);

        if ($validator->fails()) {
//            Alert::error("Error", "Isian kurang lengkap");
//            return back()->withErrors($validator)->withInput();
            return response()->json(['errors' => $validator->errors()], 409);
        }

        $announcementID = $request->announcement_id;

        $usecase = new DeleteAnnouncementUsecase($this->announcementRepository);
        $response = $usecase->execute($announcementID);

        return response()->json([$response], 200);
    }
}
