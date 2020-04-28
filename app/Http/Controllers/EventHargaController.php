<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Support\Guzzle\GuzzleConfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use DateTime;
use File;

class EventHargaController extends Controller
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

	function guzzleMultipart($method, $url, $form){
		$base_url =  env('URL_API');
		$token = request()->session()->get('pabi_token_api');
		$client = new \GuzzleHttp\Client();
		$response = $client->request($method, $base_url.$url, [
			'headers' => [
				'Accept'        => 'application/json',
				'Authorization' => $token
			],
			'multipart' => $form
		]);
		return $response;
	}

	public function modal_daftar_harga_event($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];
            return view('public_admin.master_event.sa.harga_event.modal_harga_event', compact('data_event'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        } 
    }

    public function div_tabel_data_harga_event($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event-harga/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_harga = $response['data'];
            return view('public_admin.master_event.sa.harga_event.div_tabel_data_harga_event'
                , compact('data_harga', 'id'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }   
    }

    public function simpan_harga_event(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('POST','event-harga/create',[
                'event_id' => $id,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'kuota_peserta' => $request->kuota_peserta
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            if($response['message'] == 'failed'){
                echo $response['info'];
            } else {
                echo $response['message']; 
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            echo $response['info']; 
        }
    }

    public function delete_harga_event($id)
    {   
        try{
            $response = $this->guzzle('POST', 'event-harga/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            echo "sukses";
            //return redirect('admin/myprofile')->withErrors($response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //return redirect()->back()->withErrors($message);
        }
    }

    public function edit_harga_event(Request $request, $id)
    {    
        try{
            $response = $this->guzzle('POST','event-harga/update/'.$id,[  
                'harga' => "",
                'kategori' => "",
                'event_id' => "",
                'kuota_peserta' => "", 

                'status_harga' => $request->val 
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo "success";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            echo $response['info'];
        }
    }

    public function div_tambah_data_harga_event($id)
    {
        $id_event = $id;
        return view('public_admin.master_event.sa.harga_event.form_tambah_harga_event', compact('id_event'));   
    }

    public function div_ubah_data_harga_event($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event-harga/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_harga = $response['data'];
            $id_event_harga = $data_harga['id'];
            $id_event = $data_harga['event_id'];
            return view('public_admin.master_event.sa.harga_event.form_ubah_harga_event', compact('data_harga', 'id_event_harga', 'id_event'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }   
    }

    public function simpan_harga_event_ubah(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('POST','event-harga/update/'.$id,[
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'kuota_peserta' => $request->kuota_peserta
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            if($response['message'] == 'failed'){
                echo $response['info'];
            } else {
                echo $response['message']; 
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            echo $response['info']; 
        }
    }
}
