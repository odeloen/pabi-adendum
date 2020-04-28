<?php

namespace App\Ods\Core\Requests;

class UseCaseRequest
{
    public $user;
    public $userRequest;

    public function __construct($request = null, $user = null){
        $this->user = $user;
        $this->userRequest = $request;
    }
}
