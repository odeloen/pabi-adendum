<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Course;

interface ICourseSearchRepository
{
    /**
     * @param $query
     * @return Course[]
     */
    public function search($query);
}
