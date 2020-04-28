<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class NotifController extends Controller
{
    function guzzle($method,$url,$form){
        $base_url =  env('URL_API');
        $token = request()->session()->get('pabi_token_api');
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

    public function get_notif(Request $request) {
        $response_notif = $this->guzzle('GET', 'notification/'.session('pabi_user_id'), []);
        $response_notif = json_decode($response_notif->getBody()->getContents(), true);
        $data_notif = $response_notif['data'];
        $data_count = $response_notif['count'];
        $data_notif_count = $response_notif['unseen_notif'];
        $result = '';

        if ($request->read !== null && $request->userId !== null) {
            $this->guzzle('POST','notification/update/'.session('pabi_user_id'),[]);
        }

        if ($data_count > 0) {
            foreach ($data_notif as $row) {
                $date = Carbon::parse($row['created_at'])->diffForhumans();
    
                $result .= '<li class="media"><div class="media-left">
                        <a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs"><i class="icon-bubble8"></i></a>
                    </div>
                <div class="media-body">
                    <a href="#">'. $row["subject"] .'</a>
                    <p>'. $row["body"] .'</p>
                    <div class="media-annotation">'. $date .'</div>
                </div></li>';
            }
        } else {
            $result .= '<li class="media"><div class="media-left">
                <a href="#">Notification Not Found</a>
            </li>';
        }

        return response()->json([ 
            'notification' => $result,
            'unseenNotif' => $data_notif_count
        ]);
    }
}
