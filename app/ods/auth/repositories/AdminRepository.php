<?php

namespace App\Ods\Auth\Repositories;

use App\Ods\Auth\Entities\Admin;
use App\Ods\Utils\Guzzle\KodigAPITrait;

class AdminRepository
{
    use KodigAPITrait;

    public function findAuthenticated(){
        // return Admin::find(1);

        // $form = [
        //     'token' => request()->session()->get('pabi_token_api'),
        // ];

        // $response = $this->guzzle('POST', 'user/token', $form);

        // $response = json_decode($response->getBody()->getContents(), true);
        // dd($response);
        // $data = $response['data'];

        // $admin = Admin::create($data['user_id'], $data['username'], $data['email']);

        return null;
    }
}
