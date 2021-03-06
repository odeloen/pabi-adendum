<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

interface ITopicRepository
{
    /**
     * @param String $courseID
     * @return Topic[]
     */
    public function findByCourseID(String $courseID);

    /**
     * @param String $topicID
     * @return Topic
     */
    public function findByID(String $topicID);

    /**
     * @return IMaterialRepository
     */
    public function getMaterialRepository();

    public function insert(Topic $topic);
    public function update(Topic $topic);
    public function delete(Topic $topic);
}
