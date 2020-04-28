<?php

namespace App\Ods\Utils\Guzzle;
trait KeuanganAPITrait {
    private function guzzleKeuangan($method, $url, $form){
        $base_url =  "http://pabi.ttech.co.id/api/";        
        
        $client = new \GuzzleHttp\Client();
        // dd($base_url.$url);
        $response = $client->request($method, $base_url.$url, [            
            'form_params' => $form
        ]);

        return $response;
    }    
}
