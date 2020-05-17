<?php


namespace App\Ods\Elearning\Course\Domain\Repositories;


use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

interface IMaterialRepository
{
    /**
     * @param Topic $topic
     * @return Material[]
     */
    public function findByTopic(Topic $topic);

    /**
     * @param String $materialID
     * @return Material
     */
    public function findByID(String $materialID);

    public function insert(Material $material);
    public function update(Material $material);
    public function delete(Material $material);
}
