<?php


namespace App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Models;


use App\Ods\Announcement\Domain\Entities\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class AnnouncementDataModel extends Model
{
    use SoftDeletes;

    protected $connection = 'odssql';

    protected $table = 'announcements';
    public $incrementing = false;

    public static function create(Announcement $announcementDomainModel){
        $announcementDataModel = new AnnouncementDataModel();
        $announcementDataModel->id = Uuid::uuid4()->toString();
        $announcementDataModel->title = $announcementDomainModel->getTitle();
        $announcementDataModel->description = $announcementDomainModel->getDescription();
        $announcementDataModel->deleted_at = $announcementDomainModel->getDeletedAt();
        $announcementDataModel->created_at = $announcementDomainModel->getCreatedAt();
        $announcementDataModel->updated_at = $announcementDomainModel->getUpdatedAt();

        return $announcementDataModel;
    }
}
