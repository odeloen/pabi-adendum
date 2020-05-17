<?php


namespace App\Ods\Elearning\Course\Domain\Application\Course;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

class GetCourseDetailDTO
{
    /**
     * @var Course $course
     */
    public $course;

    /**
     * @var Topic[] $topics
     */
    public $topics;

    /**
     * GetCourseDetailDTO constructor.
     * @param Course $course
     * @param Topic[] $topics
     */
    public function __construct(
        Course $course,
        array $topics
    ){
        $this->lecturer = $course->getLecturer();
        $this->course = $course;
        $this->topics = $topics;
    }
}
