<?php


namespace App\Ods\Elearning\Course\Infrastructure\Factories;


use App\Ods\Auth\Repositories\MemberRepository;
use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

class DomainEntityFactory
{
    /* @return Course*/
    public static function createCourse($courseDataModel)
    {
        $memberRepository = new MemberRepository();
        $lecturer = $memberRepository->find($courseDataModel->lecturer_id);
        $course = new Course($courseDataModel->id, $courseDataModel->name, $courseDataModel->description, $lecturer);

        return $course;
    }

    public static function createTopic($topicDataModel)
    {
        $topic = new Topic($topicDataModel->id, $topicDataModel->name, $topicDataModel->description);

        return $topic;
    }

    public static function createMaterial($materialDataModel)
    {
        $material = new Material($materialDataModel->id, $materialDataModel->name, $materialDataModel->description);

        return $material;
    }
}
