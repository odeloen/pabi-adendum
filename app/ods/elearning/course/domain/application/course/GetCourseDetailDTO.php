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
    private $course;

    /**
     * @var Topic[] $topics
     */
    private $topics;

    /**
     * GetCourseDetailDTO constructor.
     * @param Course $course
     * @param Topic[] $topics
     */
    public function __construct(
        Course $course,
        array $topics
    ){
        $this->course = $course;
        $this->topics = $topics;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @return Topic[]
     */
    public function getTopics(): array
    {
        return $this->topics;
    }
}
