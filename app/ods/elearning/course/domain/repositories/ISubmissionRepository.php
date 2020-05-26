<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;

interface ISubmissionRepository
{
    /**
     * @param String $courseID
     * @return Course
     */
    public function findByCourseID(String $courseID);

    public function submit(String $courseID);

    public function accept(String $courseID);

    public function decline(String $courseID, $comment);
}
