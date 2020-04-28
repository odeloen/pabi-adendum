<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use File;
use DateTime;

class KreditPoinController extends Controller
{
    function guzzle($method,$url,$form)
	{
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

	function status_response($status)
	{
		if($status == '401') {
			$message = "Silahkan Login Kembali";
			return redirect('login')->withErrors($message);
		}
	}

	public function master_kredit_poin_member()
	{
		try {
			$response = $this->guzzle('POST', 'public/member', []);
            $response = json_decode($response->getBody()->getContents(), true);
			$data_member = $response['data'];

			session()->put('nama_menu_sidebar', 'kredit_poin_member');
            session()->put('nama_menu_header', 'Kredit Point');
			return view('public_admin.kredit_poin.master_kredit_poin', compact('data_member'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function master_kredit_poin()
	{
		try {
			$response = $this->guzzle('POST', 'public/member', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_member = $response['data'];

			session()->put('nama_menu_sidebar', 'kredit_poin');
            session()->put('nama_menu_header', 'Kredit Point');
			return view('public_admin.kredit_poin.master_kredit_poin', compact('data_member'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_kredit_poin_member(Request $request)
	{
		$url = '';
		if ($request->laporan == 1) {
			$url = 'borang/kredit-poin/tahun';
		} else if ($request->laporan == 2) {
			$url = 'borang/kredit-poin/bulan';
		} else if ($request->laporan == 3) {
			$url = 'borang/kredit-poin/tanggal';
		}
		try {
			$response = $this->guzzle('POST', $url, [
                'member_id' => $request->member_id,
                'start_date' => $request->tgl_awal,
                'end_date' => $request->tgl_akhir,
                'limit' => $request->limit
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_member = $response['data'];
			$data_bulan_tahun = null;

			if ($request->laporan == 1) {
				$data_bulan_tahun = $response['tahun'];
			} else if ($request->laporan == 2) {
				$data_bulan_tahun = $response['bulan_tahun'];
			}

			$dir = 'div_tabel_kredit_poin';
			if (session('pabi_role_id') == 4) {
				$dir = 'div_tabel_kredit_poin_member';
			}

			return view('public_admin.kredit_poin.'.$dir, compact('data_member', 'data_bulan_tahun'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_per_member(Request $request)
	{
		try {
			$response = $this->guzzle('POST', 'borang/kredit-poin/periode', [
				'member_id' => $request->member_id
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kredit_poin = $response['data'];

			return view('public_admin.kredit_poin.div_tabel_per_member', compact('data_kredit_poin'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}
}
