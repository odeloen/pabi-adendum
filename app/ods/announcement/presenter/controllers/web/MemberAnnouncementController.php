<?php


namespace App\Ods\Announcement\Presenter\Controllers\Web;

use App\Http\Controllers\Controller;
use App\ods\announcement\domain\application\GetAnnouncementDetailUsecase;
use App\Ods\Announcement\Domain\Application\GetAnnouncementListUsecase;
use App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Repositories\AnnouncementEloquentRepository;
use App\ods\announcement\presenter\models\AnnouncementViewModel;
use App\Ods\Core\Entities\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberAnnouncementController extends Controller
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

        return view('Ods\Announcement::member.list', $response->data);
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
}
