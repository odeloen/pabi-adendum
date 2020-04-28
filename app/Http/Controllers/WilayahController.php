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

class WilayahController extends Controller
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

	public function kota_by_provinsi_id(Request $request)
	{
		try{ 
			if (!empty($request->prov_id)) {
				$response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$request->prov_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_kota = $response['data'];
				echo '<option value="">-- Pilih Kabupaten/Kota --</option>';
				foreach ($data_kota as $dk) {
					$sel = '';
					if ($request->kota_id == $dk['id']) {
						$sel = 'selected=""';
					}
					echo '<option value="'.$dk['id'].'" '.$sel.'>'.$dk['nama'].'</option>';
				}
			}
		}
		catch(RequestException $e){
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			echo $response['info']; 
		} 
	}

	public function kecamatan_by_kota_id(Request $request)
	{
		try{ 
			if (!empty($request->kota_id)) {
				$response = $this->guzzle('GET', 'wilayah/kecamatan/kabupaten/'.$request->kota_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_kecamatan = $response['data'];
				echo '<option value="">-- Pilih Kecamatan Diselenggarakannya Event --</option>';
				foreach ($data_kecamatan as $dk) {
					$sel = '';
					if ($request->kec_id == $dk['id']) {
						$sel = 'selected=""';
					}
					echo '<option value="'.$dk['id'].'" '.$sel.'>'.$dk['nama'].'</option>';
				}
			}
		}
		catch(RequestException $e){
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			echo $response['info']; 
		} 
	}

}
