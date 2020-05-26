<?php


namespace App\Ods\Elearning\Course\Domain\Application\Material;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

class GetMaterialDetailDTO
{
    /**
     * @var Course $course
     */
    private $course;

    /**
     * @var Topic $topic
     */
    private $topic;

    /**
     * @var Material $material
     */
    private $material;

    /**
     * GetMaterialDetailDTO constructor.
     * @param Course $course
     * @param Topic $topic
     * @param Material|null $material
     */
    public function __construct(Course $course, Topic $topic, ?Material $material)
    {
        $this->course = $course;
        $this->topic = $topic;
        $this->material = $material;
    }

    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @return Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @return Material
     */
    public function getMaterial()
    {
        return $this->material;
    }
}
