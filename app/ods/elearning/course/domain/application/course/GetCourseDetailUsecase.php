<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class GetCourseDetailUsecase
{
    /**
     * @var ICourseRepository $courseRepository
     */
    private $courseRepository;

    /**
     * GetCourseDetailUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Get course detail with topics and their materials
     * @param String $courseID
     * @return UseCaseResponse
     */
    public function execute(String $courseID){
        $topicRepository = $this->courseRepository->getTopicRepository();

        try {
            $course = $this->courseRepository->findByID($courseID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari kelas");
        }

        if (!isset($course)) return UseCaseResponse::createErrorResponse("Kelas tidak ditemukan");

        $topics = $topicRepository->findByCourseID($courseID);

        try {

        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal mencari topik terkait");
        }

        $data = new GetCourseDetailDTO($course, $topics);

        return UseCaseResponse::createDataResponse($data);
    }
}
