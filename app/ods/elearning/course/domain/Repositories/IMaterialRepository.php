<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Core\Entities\Materials\Material;
use App\ods\elearning\course\domain\Entities\Topic;

interface IMaterialRepository
{
    public function insert(Material $material);
    public function update(Material $material);

    public function findByID($id);
    public function findByTopic(Topic $topic);
}
