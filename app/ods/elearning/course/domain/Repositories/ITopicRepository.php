<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\ods\elearning\course\domain\Entities\Topic;

interface ITopicRepository
{
    public function insert(Topic $topic);
    public function update(Topic $topic);

    public function findByID($id) : Topic;
    public function findByCourse(Course $course);
}
