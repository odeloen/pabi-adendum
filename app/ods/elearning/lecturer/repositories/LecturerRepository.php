<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Lecturer\Entities\Lecturer;
use App\Ods\Utils\Guzzle\KodigAPITrait;

class LecturerRepository
{
    use KodigAPITrait;

    public function findAuthenticated() : Lecturer
    {
        $token = request()->session()->get('pabi_token_api');
        $temp = explode(" ", $token);
        $token = $temp[1];

        $form = [
            'token' => $token,
        ];

        $response = $this->guzzle('POST', 'member/token', $form);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'];

        $lecturer = new Lecturer;

        $lecturer->id = $data['user_id'];
        $lecturer->fullname = $data['firstname'].' '.$data['lastname'];
        $lecturer->email = $data['email'];

        return $lecturer;
    }

    public function find(int $id) : Lecturer
    {
        $response = $this->guzzle('GET', 'member/user/'.$id,[]);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'][0];

        $lecturer = new Lecturer;

        $lecturer->id = $data['user_id'];
        $lecturer->fullname = $data['firstname'].' '.$data['lastname'];
        $lecturer->email = $data['email'];

        return $lecturer;
    }

    public function findByMaterial($material)
    {
        $lecturerID = $material->instance->topic->course->lecturer_id;

        $response = $this->guzzle('GET', 'member/user/'.$lecturerID,[]);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'][0];

        $lecturer = new Lecturer;

        $lecturer->id = $data['user_id'];
        $lecturer->fullname = $data['firstname'].' '.$data['lastname'];
        $lecturer->email = $data['email'];

        return $lecturer;
    }

    public function save(lecturer $lecturer) : void
    {
        $lecturer->getInstance()->save();
        return;
    }
}
