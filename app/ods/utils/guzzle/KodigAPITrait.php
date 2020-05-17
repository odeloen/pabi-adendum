<?php

namespace App\Ods\Utils\Guzzle;
trait KodigAPITrait {
    function guzzle($method, $url, $form){
        $base_url =  env('URL_API');

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

        $client = new \GuzzleHttp\Client();
        $response = $client->request($method, $base_url.$url, [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => $token
            ],
            'form_params' => $form
        ]);

        return $response;
    }
}
