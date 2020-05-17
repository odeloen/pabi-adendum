<?php


namespace App\Ods\Announcement\Domain\Repositories;


use App\Ods\Announcement\Domain\Entities\Announcement;

interface IAnnouncementRepository
{
    public function all();
    public function findNewest(int $count);
    public function findByID(String $id);

    public function insert(Announcement $announcement, $image);
    public function delete(Announcement $announcement);
}
