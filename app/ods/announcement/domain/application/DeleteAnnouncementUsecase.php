<?php


namespace App\Ods\Announcement\Domain\Application;

use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Core\Requests\UseCaseResponse;

class DeleteAnnouncementUsecase
{
    private $announcementRepository;

    public function __construct(IAnnouncementRepository $announcementRepository){
        $this->announcementRepository = $announcementRepository;
    }

    public function execute(String $announcementID){
        try {
            $announcement = $this->announcementRepository->findByID($announcementID);
        } catch (\Exception $e) {
            return UseCaseResponse::createErrorResponse('Gagal mencari pengumuman');
        }

        if (!isset($announcement)) return UseCaseResponse::createErrorResponse('Tidak menemukan pengumuman yang dicari');

        try {
            $this->announcementRepository->delete($announcement);
        } catch (\Exception $e) {
            return UseCaseResponse::createErrorResponse('Gagal menghapus pengumuman');
        }

        return UseCaseResponse::createMessageResponse('Berhasil menghapus pengumuman');
    }
}
