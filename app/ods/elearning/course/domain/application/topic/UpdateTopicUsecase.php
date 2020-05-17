<?php


namespace App\Ods\Elearning\Course\Domain\Application\Topic;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;

class UpdateTopicUsecase
{
    /**
     * @var ITopicRepository
     */
    private $topicRepository;

    /**
     * UpdateTopicUsecase constructor.
     * @param ITopicRepository $topicRepository
     */
    public function __construct(ITopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * @param String $topicID
     * @param String $name
     * @param String $description
     * @return UseCaseResponse
     */
    public function execute(String $topicID, String $name, String $description){
        try {
            $topic = $this->topicRepository->findByID($topicID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari topik");
        }

        if (!isset($topic)) return UseCaseResponse::createErrorResponse("Topik tidak ditemukan");

        $topic->update($name, $description);

        try {
            $this->topicRepository->insert($topic);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan topik");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan topik");
    }
}
