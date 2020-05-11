<?php


namespace App\Ods\Announcement\Domain\Application;


use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Core\Requests\UseCaseResponse;

class GetAnnouncementListUsecase
{
    private $announcementRepository;

    public function __construct(IAnnouncementRepository $announcementRepository){
        $this->announcementRepository = $announcementRepository;
    }

    public function execute(){
        try {
            $announcements = $this->announcementRepository->all();
        } catch (\Exception $e) {
            return UseCaseResponse::createErrorResponse("Gagal mencari pengumuman terkait");
        }

        return UseCaseResponse::createDataResponse($announcements);
    }
}
