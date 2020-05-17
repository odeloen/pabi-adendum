<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class DeleteCourseUsecase
{
    private $courseRepository;

    /**
     * DeleteCourseUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param String $courseID
     * @return UseCaseResponse
     */
    public function execute(String $courseID){
        try {
            $course = $this->courseRepository->findByID($courseID);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal mencari kelas");
        }

        if (!isset($course)) return UseCaseResponse::createErrorResponse("Kelas tidak ditemukan");

        $course->markDeleted();

        try {
            $this->courseRepository->update($course);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal menyimpan kelas");
        }

        if ($course->canBeDeleted()) {
            try {
                $this->courseRepository->delete($course);
            } catch (\Exception $exception) {
                return UseCaseResponse::createErrorResponse("Gagal menghapus kelas");
            }
        }

        return UseCaseResponse::createMessageResponse("Berhasil menghapus kelas");
    }
}
