<?php


namespace App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Repositories;

use App\Ods\Announcement\Domain\Entities\Announcement;
use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Models\AnnouncementDataModel;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class AnnouncementEloquentRepository implements IAnnouncementRepository
{
    private $imageDirectory = 'Ods/announcement/images/';

    private function mapDataModelToDomainModel(AnnouncementDataModel $announcementDataModel){
        $announcementDomainModel = Announcement::create(
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

        $res = [];
        foreach ($announcements as $announcement){
            $res[] = $this->mapDataModelToDomainModel($announcement);
        }

        return collect($res);
    }

    public function findByID(String $announcementID){
        $announcement = AnnouncementDataModel::where('id',$announcementID)->first();

        if (empty($announcement)) return null;

        return $this->mapDataModelToDomainModel($announcement);
    }

    public function insert(Announcement $announcementDomainModel, $image = null){
        $announcementDataModel = AnnouncementDataModel::create($announcementDomainModel);

        $this->insertImage($announcementDataModel, $image);

        $announcementDataModel->save();
    }

    public function delete(Announcement $announcementDomainModel){
        $announcementDataModel = AnnouncementDataModel::find($announcementDomainModel->getId());

        $this->deleteImage($announcementDataModel);

        $announcementDataModel->delete();
    }

    private function insertImage(AnnouncementDataModel $announcement, $image){
        if ($image == null) throw new \Exception('Image is null');

        if (isset($announcement->image_path) && file_exists(storage_path('app/' . $announcement->image_path))) {
            unlink(storage_path('app/'.$announcement->image_path));
        }

        $filePath = $image->store('public/'.$this->imageDirectory);

        $announcement->image_path = $filePath;
    }

    private function deleteImage(AnnouncementDataModel $announcement){
        if (isset($announcement->image_path) && file_exists(storage_path('app/' . $announcement->image_path))) {
            unlink(storage_path('app/' . $announcement->image_path));
        }
    }
}
