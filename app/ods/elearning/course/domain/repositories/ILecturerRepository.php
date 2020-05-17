<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Entities\Material;

interface ILecturerRepository
{
    /**
     * @param int $lecturerID
     * @return Lecturer
     */
    public function findByID(int $lecturerID);

    /**
     * @param Material $material
     * @return Lecturer
     */
    public function findByMaterial(Material $material);
}
