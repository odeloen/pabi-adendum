<?php

namespace App\Ods\Elearning\Member\Usecases;


use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Core\Requests\UseCaseResponse;

class GetFollowedCourseListUseCase
{
    private $courseRepository;
    private $lecturerRepository;

    public function __construct($courseRepository, $lecturerRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->lecturerRepository = $lecturerRepository;
    }

    public function execute($member) : UseCaseResponse
    {
        $courses = $this->courseRepository->findFollowedByMember($member);

        if (!empty($courses)){
            foreach ($courses as $course) {
                $course->lecturer = $this->lecturerRepository->find($course->instance->lecturer_id);
            }
        }

        try {

        } catch (\Throwable $th) {
            $response = UseCaseResponse::createErrorResponse('Gagal mendapatkan informasi kelas yang diikuti');
            return $response;
        }

        $data = [
            'courses' => $courses,
        ];

        $response = UseCaseResponse::createDataResponse($data);

        return $response;
    }
}
