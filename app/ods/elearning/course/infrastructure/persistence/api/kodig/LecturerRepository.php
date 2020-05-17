<?php


namespace App\Ods\Elearning\Course\Infrastructure\Persistence\Api\Kodig;

use App\Ods\Elearning\Course\Domain\Entities\Lecturer;
use App\Ods\Elearning\Course\Domain\Entities\Material;
use App\Ods\Elearning\Course\Domain\Repositories\ILecturerRepository;
use App\Ods\Utils\Guzzle\KodigAPITrait;

class LecturerRepository implements ILecturerRepository
{
    use KodigAPITrait;

    /**
     * @param int $lecturerID
     * @return Lecturer
     */
    public function findByID(int $lecturerID)
    {
        return $this->getDataFromServer($lecturerID);
    }

    /**
     * @param Material $material
     * @return Lecturer
     */
    public function findByMaterial(Material $material)
    {

    }

    private function getDataFromServer(int $id){
        $response = $this->guzzle('GET', 'member/user/'.$id,[]);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'][0];

        $lecturerID = $data['user_id'];
        $lecturerFullname = $data['firstname'].' '.$data['lastname'];

        $lecturer = new Lecturer($lecturerID, $lecturerFullname);

        return $lecturer;
    }
}
