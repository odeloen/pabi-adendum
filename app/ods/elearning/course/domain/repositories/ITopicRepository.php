<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

interface ITopicRepository
{
    /**
     * @param Course $course
     * @return Topic[]
     */
    public function findByCourse(Course $course);

    /**
     * @param String $topicID
     * @return Topic
     */
    public function findByID(String $topicID);

    public function insert(Topic $topic);
    public function update(Topic $topic);
    public function delete(Topic $topic);
}
