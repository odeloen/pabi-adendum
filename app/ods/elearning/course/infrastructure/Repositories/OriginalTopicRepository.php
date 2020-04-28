<?php


namespace App\Ods\Elearning\Course\Infrastructure\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\ods\elearning\course\domain\Entities\Topic;
use App\Ods\Elearning\Course\Domain\Repositories\ITopicRepository;

class OriginalTopicRepository implements ITopicRepository
{
    public function insert(Topic $topic)
    {
        // TODO: Implement insert() method.
    }

    public function update(Topic $topic)
    {
        // TODO: Implement update() method.
    }

    public function findByID($id): Topic
    {
        // TODO: Implement findByID() method.
    }

    public function findByCourse(Course $course)
    {
        // TODO: Implement findByCourse() method.
    }

}
