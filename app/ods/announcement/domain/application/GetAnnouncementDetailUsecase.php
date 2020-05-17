<?php


namespace App\ods\announcement\domain\application;


use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Core\Requests\UseCaseResponse;

class GetAnnouncementDetailUsecase
{
    private $announcementRepository;

    public function __construct(IAnnouncementRepository $announcementRepository){
        $this->announcementRepository = $announcementRepository;
    }

    public function execute(String $announcementID){
        try {
            $announcement = $this->announcementRepository->findByID($announcementID);
        } catch (\Exception $e) {
            return UseCaseResponse::createErrorResponse("Gagal mencari pengumuman terkait");
        }

        if (empty($announcement)) return UseCaseResponse::createErrorResponse("Tidak dapat menemukan pengumuman terkait");

        $data = [
            'announcement' => $announcement,
        ];

        return UseCaseResponse::createDataResponse($data);
    }
}
