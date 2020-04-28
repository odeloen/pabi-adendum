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

class MemberJurnalController extends Controller
{
    public function simpan_ubah_my_profile_data_jurnal(Request $request, $id)
	{
		$tgl = new DateTime();
		$r = $request->file('file_name');
		$path = $r->getPathname();
		$org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
		$mime = $r->getmimeType();
		try{
			$response = $this->guzzleMultipart('POST','jurnal/create', [
				[
					'name' => 'member_id',
					'contents' => $id
				],
				[
					'name' => 'judul',
					'contents' => $request->judul
				],
				[
					'name' => 'tgl_terbit',
					'contents' => $request->tgl_terbit
				],
				[
					'Content-type' => 'multipart/form-data',
					'name' => 'file_name',
					'filename' => $org,
					'Mime-Type'=> $mime,
					'contents' => fopen($path, 'r')
				]
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			echo $response['info'];
            //echo "Create Member Jurnal Success";
		}
		catch(RequestException $e){
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			echo $response['info'];
		}
	}

	public function tabel_detail_jurnal_hapus($id)
	{   
		try{
			$response = $this->guzzle('POST', 'jurnal/delete/'.$id, []);
			$response = json_decode($response->getBody()->getContents(), true);
			echo $response['info'];
            //return redirect('admin/myprofile')->withErrors($response['info']);
		}
		catch(RequestException $e){
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			echo $response['info'];
            //return redirect()->back()->withErrors($message);
		}
	}

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
}
