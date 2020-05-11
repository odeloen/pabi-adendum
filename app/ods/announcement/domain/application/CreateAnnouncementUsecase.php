<?php


namespace App\Ods\Announcement\Domain\Application;

use App\Ods\Announcement\Domain\Entities\Announcement;
use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Core\Requests\UseCaseResponse;
use Illuminate\Support\Facades\DB;

class CreateAnnouncementUsecase
{
    private $announcementRepository;

    public function __construct(IAnnouncementRepository $announcementRepository){
        $this->announcementRepository = $announcementRepository;
    }

    public function execute(String $title, String $description, $image = null){
        $announcement = new Announcement();
        $announcement->setTitle($title);
        $announcement->setDescription($description);

        try {
            $this->announcementRepository->insert($announcement, $image);
        } catch (\Exception $e){
            return UseCaseResponse::createErrorResponse('Gagal memasukkan pengumuman');
        }

        return UseCaseResponse::createMessageResponse('Berhasil membuat pengumuman');
    }
}
