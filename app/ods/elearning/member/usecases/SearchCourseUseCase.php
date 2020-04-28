<?php

namespace App\Ods\Elearning\Member\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class SearchCourseUseCase
{
    private $courseRepository;
    private $lecturerRepository;

    public function __construct($courseRepository, $lecturerRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->lecturerRepository = $lecturerRepository;
    }

    public function execute($query) : UseCaseResponse
    {
        $courses = $this->courseRepository->search($query);

        try {
            if (!empty($courses)){
                foreach($courses as $course){
                    $course->lecturer = $this->lecturerRepository->find($course->instance->lecturer_id);
                }
            }
        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapat kelas');
            return $response;
        }

        $data = [
            'courses' => $courses,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
