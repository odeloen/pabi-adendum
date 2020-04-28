<?php

namespace App\Ods\Core\Entities;

use Illuminate\Support\Facades\Session;


class Alert
{
    public $title;
    public $text;
    public $type;

    private function flash(){
        Session::flash('swal', json_encode($this));
    }

    private function __construct($title, $text, $type){
        $this->title = $title;
        $this->text = $text;
        $this->type = $type;
    }

    public static function success($title = "", $text = ""){
        $alert = new Alert($title, $text, "success");
        $alert->flash();

        return $alert;
    }

    public static function warning($title = "", $text = ""){
        $alert = new Alert($title, $text, "warning");

        $alert->flash();

        return $alert;
    }

    public static function error($title = "", $text = ""){
        $alert = new Alert($title, $text, "error");

        $alert->flash();

        return $alert;
    }

    public static function fromResponse($response){
        if ($response->hasError()){
            Alert::error("Error", $response->errors['message']);
        } else if ($response->hasMessage()) {
            Alert::success("Success", $response->message);
        }
    }
}
