<?php


namespace App\Ods\Elearning\Course\Domain\Application\Topic;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;

class DeleteTopicUsecase
{
    /**
     * @var ITopicRepository
     */
    private $topicRepository;

    /**
     * DeleteTopicUsecase constructor.
     * @param ITopicRepository $topicRepository
     */
    public function __construct(ITopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * @param String $topicID
     * @return UseCaseResponse
     */
    public function execute(String $topicID){
        try {
            $topic = $this->topicRepository->findByID($topicID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari topik");
        }

        if (!isset($topic)) return UseCaseResponse::createErrorResponse("Topik tidak ditemukan");

        $topic->markDeleted();

        try {
            $this->topicRepository->update($topic);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan topik");
        }

        if ($topic->canBeDeleted()) {
            try {
                $this->topicRepository->delete($topic);
            } catch (\Exception $exception) {
                return UseCaseResponse::createErrorResponse("Gagal menghapus topik");
            }
        }

        return UseCaseResponse::createMessageResponse("Berhasil menghapus topik");
    }
}
