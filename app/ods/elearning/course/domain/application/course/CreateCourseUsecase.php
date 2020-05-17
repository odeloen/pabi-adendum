<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Repositories\ICourseRepository;

class CreateCourseUsecase
{
    /**
     * @var ICourseRepository $courseRepository
     */
    private $courseRepository;

    /**
     * CreateCourseUsecase constructor.
     * @param ICourseRepository $courseRepository
     */
    public function __construct(ICourseRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }

    public function execute(Lecturer $lecturer, String $name, String $description, $image = null){
        $course = Course::createNewCourse($lecturer, $name, $description);

        try {
            $this->courseRepository->insert($course, $image);
        } catch (\Exception $exception){
            return UseCaseResponse::createErrorResponse("Gagal membuat kelas");
        }

        return UseCaseResponse::createMessageResponse("Berhasil membuat kelas");
    }
}
