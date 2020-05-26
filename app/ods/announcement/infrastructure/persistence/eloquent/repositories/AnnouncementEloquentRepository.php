<?php


namespace App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Repositories;

use App\Ods\Announcement\Domain\Entities\Announcement;
use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Models\AnnouncementDataModel;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class AnnouncementEloquentRepository implements IAnnouncementRepository
{
    private $imageDirectory = 'Ods/announcement/images';

    private function mapDataModelToDomainModel(AnnouncementDataModel $announcementDataModel){
        $announcementDomainModel = Announcement::createFromExisting(
            $announcementDataModel->id,
            $announcementDataModel->title,
            $announcementDataModel->description,
            $announcementDataModel->image_path,
            $announcementDataModel->deleted_at,
            $announcementDataModel->created_at,
            $announcementDataModel->updated_at
        );

        return $announcementDomainModel;
    }

    /*
     * Find all announcement and sort desc by created at
     */
    public function all(){
        $announcements = AnnouncementDataModel::all()->sortByDesc('created_at');

        if (empty($announcements)) return null;

        $announcementDomainModels = [];
        foreach ($announcements as $announcement){
            $announcementDomainModels[] = $this->mapDataModelToDomainModel($announcement);
        }

        return collect($announcementDomainModels);
    }

    public function findByID(String $announcementID){
        $announcement = AnnouncementDataModel::where('id',$announcementID)->first();

        if (empty($announcement)) return null;

        return $this->mapDataModelToDomainModel($announcement);
    }

    public function findNewest(int $count){
        $announcementDataModels = AnnouncementDataModel::orderBy('created_at')->limit($count)->get();

        if (empty($announcementDataModels)) return null;

        $announcementDomainModels = [];
        foreach ($announcementDataModels as $announcementDataModel){
            $announcementDomainModels[] = $this->mapDataModelToDomainModel($announcementDataModel);
        }

        return collect($announcementDomainModels);
    }


    public function insert(Announcement $announcementDomainModel, $image = null){
        $announcementDataModel = AnnouncementDataModel::create($announcementDomainModel);
        $announcementDataModel->created_at = Carbon::now();
        $announcementDataModel->updated_at = Carbon::now();

        $this->insertImage($announcementDataModel, $image);

        $announcementDataModel->save();
    }

    public function delete(Announcement $announcementDomainModel){
        $announcementDataModel = AnnouncementDataModel::find($announcementDomainModel->getId());

        $this->deleteImage($announcementDataModel);

        $announcementDataModel->delete();
    }

    private function insertImage(AnnouncementDataModel $announcement, UploadedFile $image){
        if ($image == null) throw new \Exception('Image is null');

        if (isset($announcement->image_path) && file_exists(storage_path('app/public/' . $announcement->image_path))) {
            unlink(storage_path('app/public/'.$announcement->image_path));
        }

        $fullFilePath = $image->store('public/'.$this->imageDirectory);
        $tempArray = explode('/', $fullFilePath);

        $fileName = end($tempArray);
        $filePath = $this->imageDirectory.'/'.$fileName;

        $announcement->image_path = $filePath;
    }

    private function deleteImage(AnnouncementDataModel $announcement){
        if (isset($announcement->image_path) && file_exists(storage_path('app/public/' . $announcement->image_path))) {
            unlink(storage_path('app/public/' . $announcement->image_path));
        }
    }
}
