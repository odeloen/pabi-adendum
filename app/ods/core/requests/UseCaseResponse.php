<?php

namespace App\Ods\Core\Requests;

class UseCaseResponse
{
    public $data = [];
    public $message;
    public $errors;

    public function __construct($data, $message, $errors){
        if ($data != null) $this->data = $data;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function hasMessage(){
        return $this->message != null;
    }

    public function hasError(){
        return $this->errors != null;
    }

    public static function createMessageResponse($message){
        $response = new UseCaseResponse(null, $message, null);

        return $response;
    }

    public static function createErrorResponse($errorMessage){
        $errors = ['message' => $errorMessage];
        $response = new UseCaseResponse(null, null, $errors);

        return $response;
    }

    public static function createDataResponse($data){
        $response = new UseCaseResponse($data, null, null);

        return $response;
    }
}
