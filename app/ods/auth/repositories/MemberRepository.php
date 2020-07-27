<?php

namespace App\Ods\Auth\Repositories;

use App\Ods\Auth\Entities\Member;
use App\Ods\Utils\Guzzle\KodigAPITrait;

class MemberRepository
{
    use KodigAPITrait;

    public function findAuthenticated(){
        try {
            $token = request()->session()->get('pabi_token_api');
        } catch (\Throwable $th) {

        }

        if (empty($token)){
            try {
                $token = request()->header('Authorization');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $temp = explode(" ", $token);
        $token = $temp[1];

        $form = [
            'token' => $token,
        ];

        $response = $this->guzzle('POST', 'member/token', $form);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'];

        $member = new Member;

        $member->id = $data['user_id'];
        $member->firstname = $data['firstname'];
        $member->lastname = $data['lastname'];
        $member->fullname = $data['firstname'].' '.$data['lastname'];
        $member->phonenumber = $data['no_hp'];
        $member->email = $data['email'];

        return $member;
    }

    public function find($id){
        $response = $this->guzzle('GET', 'member/user/'.$id,[]);

        $response = json_decode($response->getBody()->getContents(), true);

        $data = $response['data'][0];

        $member = new Member;

        $member->id = $data['user_id'];
        $member->pabi_sejahtera = $data['no_pabi_sejahtera'];
        $member->firstname = $data['firstname'];
        $member->lastname = $data['lastname'];
        $member->fullname = $data['firstname'].' '.$data['lastname'];
        $member->phonenumber = $data['no_hp'];
        $member->email = $data['email'];

        return $member;
    }
}
