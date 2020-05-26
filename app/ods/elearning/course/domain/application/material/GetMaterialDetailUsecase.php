<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;
use App\Ods\Elearning\Course\Domain\Repositories\IMaterialRepository;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;

class GetMaterialDetailUsecase
{
    /** @var ICourseRepository $courseRepository */
    private $courseRepository;

    /** @var ITopicRepository $topicRepository */
    private $topicRepository;

    /** @var IMaterialRepository $materialRepository */
    private $materialRepository;

    /**
     * GetMaterialDetailUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->topicRepository = $courseRepository->getTopicRepository();
        $this->materialRepository = $courseRepository->getMaterialRepository();
    }

    /**
     * @param String $courseID
     * @param String $topicID
     * @param String|null $materialID
     * @return UseCaseResponse
     */
    public function execute(String $courseID, String $topicID, ?String $materialID = null){
        try {
            $course = $this->courseRepository->findByID($courseID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari kelas");
        }

        try {
            $topic = $this->topicRepository->findByID($topicID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari topik");
        }

        $material = null;
        if (isset($materialID)){
            try {
                $material = $this->materialRepository->findByID($materialID);
            } catch (\Exception $exception){
                return UseCaseResponse::createErrorResponse("Gagal mencari materi");
            }

            if (!isset($material)) {
                return UseCaseResponse::createErrorResponse("Materi tidak ditemukan");
            }
        }

        $materialDetailDTO = new GetMaterialDetailDTO($course, $topic, $material);

        return UseCaseResponse::createDataResponse($materialDetailDTO);
    }
}
