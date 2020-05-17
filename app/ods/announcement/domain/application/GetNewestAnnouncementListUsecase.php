<?php


namespace App\Ods\Announcement\Domain\Application;


use App\Ods\Announcement\Domain\Repositories\IAnnouncementRepository;
use App\Ods\Core\Requests\UseCaseResponse;

class GetNewestAnnouncementListUsecase
{
    /**
     * @var IAnnouncementRepository
     */
    private $announcementRepository;

    /**
     * GetNewestAnnouncementListUsecase constructor.
     * @param IAnnouncementRepository $announcementRepository
     */
    public function __construct(IAnnouncementRepository $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }

    public function execute(int $count){
        try {
            $announcements = $this->announcementRepository->findNewest($count);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal mencari pengumuman");
        }

        return UseCaseResponse::createDataResponse($announcements);
    }
}
