<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;

use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class UpdateCourseUsecase
{
    private $courseRepository;

    /**
     * UpdateCourseUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param String $courseID
     * @param String $name
     * @param String $description
     * @param null $image
     * @return UseCaseResponse
     */
    public function execute(String $courseID, String $name, String $description, $image = null){
        try {
            $course = $this->courseRepository->findByID($courseID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari kelas");
        }

        if (!isset($course)) return UseCaseResponse::createErrorResponse("Kelas tidak ditemukan");

        $course->update($name, $description);

        try {
            $this->courseRepository->update($course, $image);
        } catch (\Exception $exception) {
            return UseCaseResponse::createErrorResponse("Gagal menyimpan kelas");
        }

        return UseCaseResponse::createMessageResponse("Berhasil menyimpan kelas");
    }
}
