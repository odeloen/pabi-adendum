<?php

namespace App\Ods\Utils\Guzzle;
trait KodigAPITrait {
    function guzzle($method, $url, $form){
        $base_url =  "http://156.67.219.75/api/";

        try {
            //$token = request()->session()->get('pabi_token_api');
	        $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjdiNDU4MmY5NzA3YzVlODk2NGVkYjZhM2FlOWQzZTg2YWE3NTg5MzEwNzgzNWM5ZmI2NDllMWMzNzdiNDUwNWJkNDA1MjBkMDY0YzU4M2ViIn0.eyJhdWQiOiIxIiwianRpIjoiN2I0NTgyZjk3MDdjNWU4OTY0ZWRiNmEzYWU5ZDNlODZhYTc1ODkzMTA3ODM1YzlmYjY0OWUxYzM3N2I0NTA1YmQ0MDUyMGQwNjRjNTgzZWIiLCJpYXQiOjE1ODI5NTA4NTksIm5iZiI6MTU4Mjk1MDg1OSwiZXhwIjoxNTgzMTIzNjU5LCJzdWIiOiIxNzIiLCJzY29wZXMiOltdfQ.qMuAezHKiidu3givMz7A08q0yS32aq12V-PZPR28DQgF_MJZ-Wz3O4jUkCPte3plFYEN0WgsatqzI59x9_Xm3sivMOW-vEhP9PwVWHEwYfHsvIOD81lE0ubeb5RH8EOh1lpqYlYlmXI_YUqNZ-JMhjlw9zwCH7cMK3yRyi-b69oGjf54dn2HcMCqYw6foxvg5F5VAuZZzU7Z7psxXQi0tQ8Z_qeo4McO7WUacvcl7Yw2kg33l-zs4Xj3sdIDD_WjZPND9gd9mTL6ukNHd6rH1qwAzjoP-SG3gOxoL2iFRvgE5A3Oz66VV9p3kIWdeKZ8ltLcMHisdfWHwlY6VKjV3U5sfMTVQK0yX9cDKiI8oxoL4di2BizNqY-rSNwwp7GlcEM4ZutTbrZd6zB-hQd2N2pKW0LS8SEqHL0_vACwaHSpUezsvqqZ0e4lDElGI9pXlpwd0AT39SN30cN4AJbAVW2L0LhAUfy3XxX0SAdrMzGxdTEjEAlQuv757ewaXCshMQYEY7qfR7dmBt4q4BVrJ361j6Am9t1uUUPJbHrYJktyhKnLrCCKLlExxK_O4TNF8MSQQyeyucDb62nliMALYa7ZpNJTZCZhN4z0UPRAfnfj2Ke86o1aoReHPOLncHTwpA44RLNC12pXNol8puhu4THFxrC4g9K9rIP2vkqFzL4";
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
