<?php


namespace App\Ods\Elearning\Course\Domain\Application\Topic;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Entities\Topic;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;

class CreateTopicUsecase
{
    /**
     * @var ITopicRepository $topicRepository
     */
    private $topicRepository;

    /**
     * CreateTopicUsecase constructor.
     * @param ITopicRepository $topicRepository
     */
    public function __construct(ITopicRepository $topicRepository){
        $this->topicRepository = $topicRepository;
    }

    /**
     * @param String $courseID
     * @param String $name
     * @param String $description
     * @return UseCaseResponse
     */
    public function execute(String $courseID, String $name, String $description){
        $topic = Topic::createNewTopic($courseID, $name, $description);

        try {
            $this->topicRepository->insert($topic);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan materi");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan materi");
    }
}
