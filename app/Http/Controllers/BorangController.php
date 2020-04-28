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

class BorangController extends Controller
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

	public function jenis_kegiatan_by_borang(Request $request)
	{
		try {
			$response = $this->guzzle('GET', 'borang/jenis-kegiatan/ranah-borang/'.$request->borang, []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_jenis_kegiatan = $response['data'];
			echo '<option value="">-- Pilih Jenis Kegiatan --</option>';
			foreach ($data_jenis_kegiatan as $djk) {
				echo '<option value="'.$djk['id'].'">'.$djk['nama_jenis_kegiatan'].'</option>';
			}
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function nama_kegiatan_by_jenis_kegiatan(Request $request)
	{
		try {
			$response = $this->guzzle('GET', 'borang/kegiatan/jenis-kegiatan/'.$request->jenis_kegiatan, []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];
			echo '<option value="">-- Pilih --</option>';
			foreach ($data_kegiatan as $dk) {
				echo '<option value="'.$dk['id'].'">'.$dk['nama_kegiatan'].'</option>';
			}
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function master_borang_member()
	{
		session()->put('nama_menu_sidebar', 'master_borang');
        session()->put('nama_menu_header', 'Borang');
		return view('public_admin.master_borang.member.master_borang');
	} 
	public function master_borang_isi_kalender()
	{ 
		return view('public_admin.master_borang.member.master_borang_isi_kalender');
	}
	public function div_master_borang(Request $request)
	{
		$tgl = $request->tgl;
		$member_id = session('pabi_member_id');
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				'member_id' =>  $member_id,
                'start_date' => $tgl,
                'end_date' => $tgl
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			$response = $this->guzzle('POST', 'borang/per-tanggal', [
				'member_id' =>  $member_id 
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_pertanggal = $response['data'];

			return view('public_admin.master_borang.member.div_master_borang', compact('tgl', 'data_kegiatan', 'data_pertanggal'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}
	public function master_borang_modal_tambah(Request $request)
	{ 
		$tgl = $request->tgl;
		$member_id = session('pabi_member_id');

		try {
			// $response = $this->guzzle('GET', 'admin/pusat', []);
			// $response = json_decode($response->getBody()->getContents(), true);
			// $data_admin_pusat = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			//session()->put('nama_menu_sidebar', 'master_borang_belum_verif_pusat');
			return view('public_admin.master_borang.form_borang.modal_tambah', compact('tgl', 'member_id', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function borang_belum_verif_pusat()
	{
		try {
			$response = $this->guzzle('GET', 'admin/pusat', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_admin_pusat = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_belum_verif_pusat');
            session()->put('nama_menu_header', 'Borang Borang Belum Verifikasi');
			return view('public_admin.master_borang.admin_pusat.master_borang_belum_verif', compact('data_admin_pusat', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_borang_belum_verif_pusat(Request $request)
	{
		$admin_id = $request->admin_cabang_id;
		$role = '3';
		$cabang_verif = '1';
		$rs_verif = '2';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				'admin_id' =>  $admin_id,
                'role' => $role,
                'cabang_verif' => $cabang_verif,
                'rs_verif' => $rs_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			return view('public_admin.master_borang.admin_pusat.div_tabel_borang_belum_verif_pusat', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function borang_sudah_verif_pusat()
	{
		try {
			$response = $this->guzzle('GET', 'admin/pusat', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_admin_pusat = $response['data'];
			
			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_sudah_verif_pusat');
            session()->put('nama_menu_header', 'Borang Sudah Verifikasi');
			return view('public_admin.master_borang.admin_pusat.master_borang_sudah_verif', compact('data_admin_pusat', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_borang_sudah_verif_pusat(Request $request)
	{
		$admin_id = $request->admin_cabang_id;
		$role = '3';
		$cabang_verif = '2';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				'admin_id' =>  $admin_id,
                'role' => $role,
                'cabang_verif' => $cabang_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			return view('public_admin.master_borang.admin_pusat.div_tabel_borang_sudah_verif_pusat', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function borang_belum_verif_cabang()
	{
		try {
			$response = $this->guzzle('GET', 'admin/cabang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_admin_cabang = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_belum_verif_cabang');
            session()->put('nama_menu_header', 'Borang Belum Verifikasi Cabang');
			return view('public_admin.master_borang.admin_cabang.master_borang_belum_verif', compact('data_admin_cabang', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_borang_belum_verif_cabang(Request $request)
	{
		$admin_id = $request->admin_cabang_id;
		$role = '3';
		$cabang_verif = '1';
		$rs_verif = '2';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				'admin_id' =>  $admin_id,
                'role' => $role,
                'cabang_verif' => $cabang_verif,
                'rs_verif' => $rs_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			return view('public_admin.master_borang.admin_cabang.div_tabel_borang_belum_verif_cabang', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function borang_sudah_verif_cabang()
	{
		try {
			$response = $this->guzzle('GET', 'admin/cabang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_admin_cabang = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_sudah_verif_cabang');
            session()->put('nama_menu_header', 'Borang Sudah Verifikasi Cabang');
			return view('public_admin.master_borang.admin_cabang.master_borang_sudah_verif', compact('data_admin_cabang', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_tabel_borang_sudah_verif_cabang(Request $request)
	{
		$admin_id = $request->admin_cabang_id;
		$role = '3';
		$cabang_verif = '2';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				'admin_id' =>  $admin_id,
                'role' => $role,
                'cabang_verif' => $cabang_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			return view('public_admin.master_borang.admin_cabang.div_tabel_borang_sudah_verif_cabang', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function modal_tambah_member()
	{
		$member_id = session('pabi_member_id');
		return view('public_admin.master_borang.form_borang.
			', compact('member_id')); 
	}

	public function modal_ubah_member($id)
	{
		//return view('public_admin.master_borang.form_borang.modal_ubah'); 
	}

	public function tampilkan_form_borang_tambah(Request $request)
	{
		$member_id = $request->member_id;
		$ranah_borang_id = $request->borang_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$nama_kegiatan_id = $request->nama_kegiatan_id;
		$ranah_borang = $request->borang;
		$jenis_kegiatan = $request->jenis_kegiatan;
		$nama_kegiatan = $request->nama_kegiatan;
		$tanggal_tabel = $request->tanggal_tabel;
		$tahun_periode = date('Y', strtotime($tanggal_tabel));
		$form_borang = '';
		switch ($ranah_borang_id) {
			case '1':
			$form_borang = 'form_borang_ranah_kegiatan_pembelajaran_pribadi';
			break;
			case '2':
			$form_borang = 'form_borang_ranah_profesional';
			break;
			case '3':
			$form_borang = 'form_borang_ranah_pengabdian_masyarakat';
			break;
			case '4':
			$form_borang = 'form_borang_ranah_publikasi_ilmiah';
			break;
			case '5':
			$form_borang = 'form_borang_ranah_pengembangan_ilmu_pendidikan';
			break;
			default:
			break;
		}

		try {
			$response = $this->guzzle('GET', 'borang/kegiatan/'.$nama_kegiatan_id, []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];
			$select_nilai_skp = '<option value="">-- Pilih Nilai SKP --</option>';
			if ($data_kegiatan['range_awal'] == $data_kegiatan['range_akhir'] || $data_kegiatan['range_awal'] < 1) {
				$select_nilai_skp .= '<option value="'.$data_kegiatan['range_awal'].'">'.$data_kegiatan['range_awal'].'</option>';
			} else {
				for ($i = $data_kegiatan['range_awal']; $i <= $data_kegiatan['range_akhir']; $i++) { 
					$select_nilai_skp .= '<option value="'.$i.'">'.$i.'</option>';
				}
			}

			$data_kompetensi = null;
			if ($ranah_borang_id == 2) {
				$response = $this->guzzle('GET', 'kompetensi/group/by/jenis-tindakan', []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_kompetensi = $response['data'];
			}

			$response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

			return view('public_admin.master_borang.form_borang.'.$form_borang, compact('member_id', 'ranah_borang_id', 'jenis_kegiatan_id', 'nama_kegiatan_id', 'ranah_borang', 'jenis_kegiatan', 'nama_kegiatan', 'tanggal_tabel', 'tahun_periode', 'select_nilai_skp', 'data_rs', 'data_kompetensi'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function simpan_kegiatan_pembelajaran_pribadi(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pembelajaran-pribadi/create',[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'nama_jurnal_situsweb' => $request->nama_jurnal_situsweb,
                'judul_artikel_topik' => $request->judul_artikel_topik,
                'tempat' => $request->tempat,
                'peran_serta' => $request->peran_serta,
                'penyelenggara' => $request->penyelenggara,
                'tahun' => $request->tahun_periode,
                'nilai_skp' => $request->nilai_skp,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat,
                'rs_verif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function simpan_pengabdian_masyarakat(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pengabdian-masyarakat/create',[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'jenis_kegiatan' => $request->jenis_kegiatan_detail,
                'tanggal_selesai' => $request->tanggal_selesai,
                'nama_organisasi_event' => $request->nama_organisasi_event,
                'jabatan' => $request->jabatan,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat,
                'rs_verif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function simpan_pengembangan_ilmu_pendidikan(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pengembangan-ilmu/create',[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'judul_penelitian' => $request->judul_penelitian,
                'dipublikasikan_diserahkan_pada' => $request->ddp.' '.$request->ddp_time,
                'judul_matkul' => $request->judul_matkul,
                'institusi' => $request->institusi,
                'peran_serta' => $request->peran_serta,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat,
                'rs_verif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function simpan_profesional(Request $request)
	{
		$lokasi_koordinat_x = '';
		$lokasi_koordinat_y = '';
		if (!empty($request->koordinat)) {
			$koordinat = explode(';', $request->koordinat);
			$lokasi_koordinat_x = $koordinat[0];
			$lokasi_koordinat_y = $koordinat[1];
		}
		try{
            $response = $this->guzzle('POST','borang/kegiatan/profesional/create',[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'kode_kegiatan' => $request->kode_kegiatan,
                'jenis_kegiatan_diagnostik' => $request->jenis_kegiatan_diagnostik,
                'peran_serta_diagnostik' => $request->peran_serta_diagnostik,
                'jenis_tindakan_operasi' => $request->jenis_tindakan_operasi,
                'nama_tindakan_operasi' => $request->nama_tindakan_operasi,
                'jenis_operasi' => $request->jenis_operasi,
                'jenis_kasus_bedah' => $request->jenis_kasus_bedah,
                'jenis_tindakan_bedah' => $request->jenis_tindakan_bedah,
                'nama_tindakan_bedah' => $request->nama_tindakan_bedah,
                'jenis_kasus_rujukan' => $request->jenis_kasus_rujukan,
                'tujuan_rujukan' => $request->tujuan_rujukan,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'lokasi_koordinat_x' => $lokasi_koordinat_x,
                'lokasi_koordinat_y' => $lokasi_koordinat_y,
                'lokasi_alamat' => $request->lokasi_alamat,
                'no_rekam_medik' => $request->no_rekam_medik,
                'rs_id' => $request->rs_id
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function simpan_publikasi_ilmiah(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/publikasi-ilmiah/create',[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'judul_artikel' => $request->judul_artikel,
                'nama_buku_jurnal' => $request->nama_buku_jurnal,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat,
                'rs_verif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function tampilkan_form_borang_ubah(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$form_borang = 'form_ubah_borang_ranah_kegiatan_pembelajaran_pribadi';
				$response = $this->guzzle('GET', 'borang/kegiatan/pembelajaran-pribadi/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];				
				break;
				case '2':
				$form_borang = 'form_ubah_borang_ranah_profesional';
				$response = $this->guzzle('GET', 'borang/kegiatan/profesional/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '3':
				$form_borang = 'form_ubah_borang_ranah_pengabdian_masyarakat';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengabdian-masyarakat/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '4':
				$form_borang = 'form_ubah_borang_ranah_publikasi_ilmiah';
				$response = $this->guzzle('GET', 'borang/kegiatan/publikasi-ilmiah/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '5':
				$form_borang = 'form_ubah_borang_ranah_pengembangan_ilmu_pendidikan';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengembangan-ilmu/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				default:
				break;
			}
			//dd($data_histori_kegiatan);
			$response = $this->guzzle('GET', 'borang/kegiatan/'.$data_histori_kegiatan['master_kegiatan_id'], []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];
			$select_nilai_skp = '<option value="">-- Pilih Nilai SKP --</option>';
			if ($data_kegiatan['range_awal'] == $data_kegiatan['range_akhir'] || $data_kegiatan['range_awal'] < 1) {
				$sel_selected = '';
				if ($data_histori_kegiatan['nilai_skp'] == $data_kegiatan['range_awal']) {
					$sel_selected = ' selected=""';
				}
				$select_nilai_skp .= '<option value="'.$data_kegiatan['range_awal'].'"'.$sel_selected.'>'.$data_kegiatan['range_awal'].'</option>';
			} else {
				for ($i = $data_kegiatan['range_awal']; $i <= $data_kegiatan['range_akhir']; $i++) { 
					$sel_selected = '';
					if ($data_histori_kegiatan['nilai_skp'] == $i) {
						$sel_selected = ' selected=""';
					}
					$select_nilai_skp .= '<option value="'.$i.'"'.$sel_selected.'>'.$i.'</option>';
				}
			}

			$response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

            $data_kompetensi_o = null;
            $data_tindakan_o = null;
            $data_kompetensi_b = null;
            $data_tindakan_b = null;

            if ($ranah_borang_id == 2) {
            	$response = $this->guzzle('GET', 'kompetensi/group/by/jenis-tindakan', []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_kompetensi_o = $response['data'];
				$data_kompetensi_b = $response['data'];

				if (!empty($data_histori_kegiatan['jenis_tindakan_bedah'])) {
					$response = $this->guzzle('POST', 'kompetensi/jenis-tindakan', [
						'jenis_tindakan' => $data_histori_kegiatan['jenis_tindakan_bedah']
					]);
					$response = json_decode($response->getBody()->getContents(), true);
					$data_tindakan_b = $response['data'];
				}

				if (!empty($data_histori_kegiatan['jenis_tindakan_operasi'])) {
					$response = $this->guzzle('POST', 'kompetensi/jenis-tindakan', [
						'jenis_tindakan' => $data_histori_kegiatan['jenis_tindakan_operasi']
					]);
					$response = json_decode($response->getBody()->getContents(), true);
					$data_tindakan_o = $response['data'];
				}
            }
            //dd($data_tindakan_o);

			return view('public_admin.master_borang.form_borang_ubah.'.$form_borang, compact('data_histori_kegiatan', 'select_nilai_skp', 'data_rs', 'data_kompetensi_o', 'data_tindakan_o', 'data_kompetensi_b', 'data_tindakan_b'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function modal_detail_member(Request $request)
	{ 
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$form_borang = 'form_ubah_borang_ranah_kegiatan_pembelajaran_pribadi';
				$response = $this->guzzle('GET', 'borang/kegiatan/pembelajaran-pribadi-front/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];				
				break;
				case '2':
				$form_borang = 'form_ubah_borang_ranah_profesional';
				$response = $this->guzzle('GET', 'borang/kegiatan/profesional-front/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '3':
				$form_borang = 'form_ubah_borang_ranah_pengabdian_masyarakat';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengabdian-masyarakat-front/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '4':
				$form_borang = 'form_ubah_borang_ranah_publikasi_ilmiah';
				$response = $this->guzzle('GET', 'borang/kegiatan/publikasi-ilmiah-front/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '5':
				$form_borang = 'form_ubah_borang_ranah_pengembangan_ilmu_pendidikan';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengembangan-ilmu-front/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				default:
				break;
			}
			//dd($data_histori_kegiatan); 
			 

			return view('public_admin.master_borang.detail_modal_borang', compact('data_histori_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function modal_upload_file_borang(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		return view('public_admin.master_borang.upload_file_borang', compact('ranah_borang_id', 'histori_kegiatan_id')); 
	}

	public function destroy_member(Request $request)
	{
		//return view('public_admin.master_borang.form_borang.modal_ubah'); 
	}

	public function ubah_kegiatan_pembelajaran_pribadi(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pembelajaran-pribadi/update/'.$request->histori_id,[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'nama_jurnal_situsweb' => $request->nama_jurnal_situsweb,
                'judul_artikel_topik' => $request->judul_artikel_topik,
                'tempat' => $request->tempat,
                'peran_serta' => $request->peran_serta,
                'penyelenggara' => $request->penyelenggara,
                'tahun' => $request->tahun_periode,
                'nilai_skp' => $request->nilai_skp,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function ubah_pengabdian_masyarakat(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pengabdian-masyarakat/update/'.$request->histori_id,[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'jenis_kegiatan' => $request->jenis_kegiatan_detail,
                'tanggal_selesai' => $request->tanggal_selesai,
                'nama_organisasi_event' => $request->nama_organisasi_event,
                'jabatan' => $request->jabatan,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function ubah_pengembangan_ilmu_pendidikan(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/pengembangan-ilmu/update/'.$request->histori_id,[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'judul_penelitian' => $request->judul_penelitian,
                'dipublikasikan_diserahkan_pada' => $request->ddp.' '.$request->ddp_time,
                'judul_matkul' => $request->judul_matkul,
                'institusi' => $request->institusi,
                'peran_serta' => $request->peran_serta,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function ubah_profesional(Request $request)
	{
		$lokasi_koordinat_x = '';
		$lokasi_koordinat_y = '';
		if (!empty($request->koordinat)) {
			$koordinat = explode(';', $request->koordinat);
			$lokasi_koordinat_x = $koordinat[0];
			$lokasi_koordinat_y = $koordinat[1];
		}
		try{
            $response = $this->guzzle('POST','borang/kegiatan/profesional/update/'.$request->histori_id,[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'kode_kegiatan' => $request->kode_kegiatan,
                'jenis_kegiatan_diagnostik' => $request->jenis_kegiatan_diagnostik,
                'peran_serta_diagnostik' => $request->peran_serta_diagnostik,
                'jenis_tindakan_operasi' => $request->jenis_tindakan_operasi,
                'nama_tindakan_operasi' => $request->nama_tindakan_operasi,
                'jenis_operasi' => $request->jenis_operasi,
                'jenis_kasus_bedah' => $request->jenis_kasus_bedah,
                'jenis_tindakan_bedah' => $request->jenis_tindakan_bedah,
                'nama_tindakan_bedah' => $request->nama_tindakan_bedah,
                'jenis_kasus_rujukan' => $request->jenis_kasus_rujukan,
                'tujuan_rujukan' => $request->tujuan_rujukan,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'lokasi_koordinat_x' => $lokasi_koordinat_x,
                'lokasi_koordinat_y' => $lokasi_koordinat_y,
                'lokasi_alamat' => $request->lokasi_alamat,
                'no_rekam_medik' => $request->no_rekam_medik,
                'rs_id' => $request->rs_id
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function ubah_publikasi_ilmiah(Request $request)
	{
		try{
            $response = $this->guzzle('POST','borang/kegiatan/publikasi-ilmiah/update/'.$request->histori_id,[
                'member_id' => $request->member_id,
                'master_kegiatan_id' => $request->nama_kegiatan_id,
                'tanggal' => $request->tanggal,
                'nama_kegiatan' => $request->nama_kegiatan,
                'judul_artikel' => $request->judul_artikel,
                'nama_buku_jurnal' => $request->nama_buku_jurnal,
                'nilai_skp' => $request->nilai_skp,
                'tahun' => $request->tahun_periode,
                'rs_id' => $request->rs_id,
                'lokasi_alamat' => $request->lokasi_alamat
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
	}

	public function ajukan_borang(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$response = $this->guzzle('POST','borang/kegiatan/pembelajaran-pribadi/update/'.$histori_kegiatan_id,[
					'cabang_verif' => '1'
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];			
				break;
				case '2':
				$response = $this->guzzle('POST','borang/kegiatan/profesional/update/'.$histori_kegiatan_id,[
					'cabang_verif' => '1'
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '3':
				$response = $this->guzzle('POST','borang/kegiatan/pengabdian-masyarakat/update/'.$histori_kegiatan_id,[
					'cabang_verif' => '1'
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '4':
				$response = $this->guzzle('POST','borang/kegiatan/publikasi-ilmiah/update/'.$histori_kegiatan_id,[
					'cabang_verif' => '1'
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '5':
				$response = $this->guzzle('POST','borang/kegiatan/pengembangan-ilmu/update/'.$histori_kegiatan_id,[
					'cabang_verif' => '1'
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				default:
				break;
			}
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_data_borang_file(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$response = $this->guzzle('POST','borang/file/ranah-borang-histori',[
				'ranah_borang_id' => $ranah_borang_id, 
				'histori_kegiatan_id' => $histori_kegiatan_id
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_file = $response['data'];
			return view('public_admin.master_borang.data_upload_file_borang', compact('data_file')); 				
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function simpan_borang_file(Request $request)
	{
		$tgl = new DateTime();
		$r = $request->file('path_file');
		$path = $r->getPathname();
		$org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
		$mime = $r->getmimeType();
		try{
			$response = $this->guzzleMultipart('POST','borang/file/create', [
				[
					'name' => 'nama',
					'contents' => $request->nama
				],
				[
					'name' => 'ranah_borang_id',
					'contents' => $request->ranah_borang_id
				],
				[
					'name' => 'history_kegiatan_id',
					'contents' => $request->histori_kegiatan_id
				],
				[
					'Content-type' => 'multipart/form-data',
					'name' => 'path_file',
					'filename' => $org,
					'Mime-Type'=> $mime,
					'contents' => fopen($path, 'r')
				],
				[
					'name' => 'keterangan',
					'contents' => $request->keterangan
				],
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

	public function hapus_borang_file($id)
    {   
        try{
            $response = $this->guzzle('POST', 'borang/file/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function destroy_borang_member(Request $request)
	{ 
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$form_borang = 'form_ubah_borang_ranah_kegiatan_pembelajaran_pribadi';
				$response = $this->guzzle('POST', 'borang/kegiatan/pembelajaran-pribadi/delete/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '2':
				$form_borang = 'form_ubah_borang_ranah_profesional';
				$response = $this->guzzle('POST', 'borang/kegiatan/profesional/delete/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '3':
				$form_borang = 'form_ubah_borang_ranah_pengabdian_masyarakat';
				$response = $this->guzzle('POST', 'borang/kegiatan/pengabdian-masyarakat/delete/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '4':
				$form_borang = 'form_ubah_borang_ranah_publikasi_ilmiah';
				$response = $this->guzzle('POST', 'borang/kegiatan/publikasi-ilmiah/delete/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				case '5':
				$form_borang = 'form_ubah_borang_ranah_pengembangan_ilmu_pendidikan';
				$response = $this->guzzle('POST', 'borang/kegiatan/pengembangan-ilmu/delete/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				echo $response['message'];
				break;
				default:
				break;
			}
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function modal_verif_cabang(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$form_borang = 'form_ubah_borang_ranah_kegiatan_pembelajaran_pribadi';
				$response = $this->guzzle('GET', 'borang/kegiatan/pembelajaran-pribadi/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];				
				break;
				case '2':
				$form_borang = 'form_ubah_borang_ranah_profesional';
				$response = $this->guzzle('GET', 'borang/kegiatan/profesional/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '3':
				$form_borang = 'form_ubah_borang_ranah_pengabdian_masyarakat';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengabdian-masyarakat/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '4':
				$form_borang = 'form_ubah_borang_ranah_publikasi_ilmiah';
				$response = $this->guzzle('GET', 'borang/kegiatan/publikasi-ilmiah/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '5':
				$form_borang = 'form_ubah_borang_ranah_pengembangan_ilmu_pendidikan';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengembangan-ilmu/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				default:
				break;
			}

			return view('public_admin.master_borang.admin_cabang.modal_verif', compact('data_histori_kegiatan', 'ranah_borang_id'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function simpan_verif_cabang(Request $request)
	{
		$tgl = new DateTime();
        $cabang_tgl = $tgl->format('Y-m-d');
        $cabang_verif = 1;
        if(empty($request->cabang_verif)){
            $cabang_verif = 2;
        }
		$ranah_borang_id = $request->ranah_borang_id;
		$histori_kegiatan_id = $request->histori_kegiatan_id;
		$pesan = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$response = $this->guzzle('POST','borang/kegiatan/pembelajaran-pribadi/update/'.$histori_kegiatan_id,[
					'cabang_verif' => $cabang_verif,
					'cabang_ket' => $request->cabang_ket,
					'cabang_tgl' => $cabang_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '2':
				$response = $this->guzzle('POST','borang/kegiatan/profesional/update/'.$histori_kegiatan_id,[
					'cabang_verif' => $cabang_verif,
					'cabang_ket' => $request->cabang_ket,
					'cabang_tgl' => $cabang_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '3':
				$response = $this->guzzle('POST','borang/kegiatan/pengabdian-masyarakat/update/'.$histori_kegiatan_id,[
					'cabang_verif' => $cabang_verif,
					'cabang_ket' => $request->cabang_ket,
					'cabang_tgl' => $cabang_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '4':
				$response = $this->guzzle('POST','borang/kegiatan/publikasi-ilmiah/update/'.$histori_kegiatan_id,[
					'cabang_verif' => $cabang_verif,
					'cabang_ket' => $request->cabang_ket,
					'cabang_tgl' => $cabang_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '5':
				$response = $this->guzzle('POST','borang/kegiatan/pengembangan-ilmu/update/'.$histori_kegiatan_id,[
					'cabang_verif' => $cabang_verif,
					'cabang_ket' => $request->cabang_ket,
					'cabang_tgl' => $cabang_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				default:
				break;
			}
			if ($pesan == 'success') {
				session()->put('status', 'Verifikasi Borang Berhasil Tersimpan');	
			} else {
				session()->put('statusT', 'Verifikasi Borang Gagal Tersimpan');
			}   
            return redirect('admin/master_borang_belum_verif_cabang');
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function rs_borang_belum_verif()
	{
		try {
			$response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_belum_verif_rs');
            session()->put('nama_menu_header', 'Borang Belum Verifikasi Rumah Sakit');
			return view('public_admin.master_borang.rumah_sakit.master_borang_belum_verif', compact('data_rs', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_rs_tabel_borang_belum_verif(Request $request)
	{
		$rs_id = $request->rs_id;
		$rs_verif = '1';
		//$admin_id = $request->admin_cabang_id;
		//$role = '3';
		//$cabang_verif = '1';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				//'admin_id' =>  $admin_id,
                //'role' => $role,
                //'cabang_verif' => $cabang_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit,
                'rs_id' => $rs_id,
                'rs_verif' => $rs_verif
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];
			//dd($data_kegiatan);

			return view('public_admin.master_borang.rumah_sakit.div_tabel_borang_belum_verif_rs', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function rs_borang_sudah_verif()
	{
		try {
			$response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

			$response = $this->guzzle('GET', 'borang/ranah-borang', []);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_ranah_borang = $response['data'];

			session()->put('nama_menu_sidebar', 'master_borang_sudah_verif_rs');
            session()->put('nama_menu_header', 'Borang Sudah Verifikasi Rumah Sakit');
			return view('public_admin.master_borang.rumah_sakit.master_borang_sudah_verif', compact('data_rs', 'data_ranah_borang'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function div_rs_tabel_borang_sudah_verif(Request $request)
	{
		$rs_id = $request->rs_id;
		$rs_verif = '2';
		// $admin_id = $request->admin_cabang_id;
		// $role = '3';
		// $cabang_verif = '2';
		$kegiatan_id = $request->kegiatan_id;
		$jenis_kegiatan_id = $request->jenis_kegiatan_id;
		$ranah_borang_id = $request->ranah_borang_id;
		$nama_member = $request->nama_member;
		$start_date = $request->tgl_borang_awal;
		$end_date = $request->tgl_borang_akhir;
		$limit = $request->limit;
		try {
			$response = $this->guzzle('POST', 'borang/kegiatan/all', [
				// 'admin_id' =>  $admin_id,
    			//'role' => $role,
    			//'cabang_verif' => $cabang_verif,
                'kegiatan_id' => $kegiatan_id,
                'jenis_kegiatan_id' => $jenis_kegiatan_id,
                'ranah_borang_id' => $ranah_borang_id,
                'nama_member' => $nama_member,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'limit' => $limit,
                'rs_id' => $rs_id,
                'rs_verif' => $rs_verif
			]);
			$response = json_decode($response->getBody()->getContents(), true);
			$data_kegiatan = $response['data'];

			return view('public_admin.master_borang.rumah_sakit.div_tabel_borang_sudah_verif_rs', compact('data_kegiatan'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function modal_verif_rs(Request $request)
	{
		$ranah_borang_id = $request->rb_id;
		$histori_kegiatan_id = $request->id;
		$form_borang = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$form_borang = 'form_ubah_borang_ranah_kegiatan_pembelajaran_pribadi';
				$response = $this->guzzle('GET', 'borang/kegiatan/pembelajaran-pribadi/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];				
				break;
				case '2':
				$form_borang = 'form_ubah_borang_ranah_profesional';
				$response = $this->guzzle('GET', 'borang/kegiatan/profesional/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '3':
				$form_borang = 'form_ubah_borang_ranah_pengabdian_masyarakat';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengabdian-masyarakat/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '4':
				$form_borang = 'form_ubah_borang_ranah_publikasi_ilmiah';
				$response = $this->guzzle('GET', 'borang/kegiatan/publikasi-ilmiah/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				case '5':
				$form_borang = 'form_ubah_borang_ranah_pengembangan_ilmu_pendidikan';
				$response = $this->guzzle('GET', 'borang/kegiatan/pengembangan-ilmu/'.$histori_kegiatan_id, []);
				$response = json_decode($response->getBody()->getContents(), true);
				$data_histori_kegiatan = $response['data'][0];
				break;
				default:
				break;
			}

			return view('public_admin.master_borang.rumah_sakit.modal_verif', compact('data_histori_kegiatan', 'ranah_borang_id'));
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function simpan_verif_rs(Request $request)
	{
		$tgl = new DateTime();
        $rs_tgl = $tgl->format('Y-m-d');
        $rs_verif = 1;
        if(empty($request->rs_verif)){
            $rs_verif = 2;
        }
		$ranah_borang_id = $request->ranah_borang_id;
		$histori_kegiatan_id = $request->histori_kegiatan_id;
		$pesan = '';
		try {
			$data_histori_kegiatan = null;
			switch ($ranah_borang_id) {
				case '1':
				$response = $this->guzzle('POST','borang/kegiatan/pembelajaran-pribadi/update/'.$histori_kegiatan_id,[
					'rs_verif' => $rs_verif,
					'rs_ket' => $request->rs_ket,
					'rs_tgl' => $rs_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '2':
				$response = $this->guzzle('POST','borang/kegiatan/profesional/update/'.$histori_kegiatan_id,[
					'rs_verif' => $rs_verif,
					'rs_ket' => $request->rs_ket,
					'rs_tgl' => $rs_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '3':
				$response = $this->guzzle('POST','borang/kegiatan/pengabdian-masyarakat/update/'.$histori_kegiatan_id,[
					'rs_verif' => $rs_verif,
					'rs_ket' => $request->rs_ket,
					'rs_tgl' => $rs_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '4':
				$response = $this->guzzle('POST','borang/kegiatan/publikasi-ilmiah/update/'.$histori_kegiatan_id,[
					'rs_verif' => $rs_verif,
					'rs_ket' => $request->rs_ket,
					'rs_tgl' => $rs_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				case '5':
				$response = $this->guzzle('POST','borang/kegiatan/pengembangan-ilmu/update/'.$histori_kegiatan_id,[
					'rs_verif' => $rs_verif,
					'rs_ket' => $request->rs_ket,
					'rs_tgl' => $rs_tgl
				]);
				$response = json_decode($response->getBody()->getContents(), true);
				$pesan = $response['message'];
				break;
				default:
				break;
			}
			if ($pesan == 'success') {
				session()->put('status', 'Verifikasi Borang Berhasil Tersimpan');	
			} else {
				session()->put('statusT', 'Verifikasi Borang Gagal Tersimpan');
			}   
            return redirect('rumah-sakit/master_borang_belum_verif');
		}
		catch(RequestException $e) {
			$response = json_decode($e->getResponse()->getBody()->getContents(),true);
			dd($response);
		}
	}

	public function tindakan_by_jenis_tindakan(Request $request)
	{
		try{
            $response = $this->guzzle('POST','kompetensi/jenis-tindakan',[
                'jenis_tindakan' => $request->jenis_tindakan
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['message'] == 'success') {
            	$data_tindakan = $response['data'];
            	foreach ($data_tindakan as $dt) {
            		echo '<option value="'.$dt['tindakan'].'">'.$dt['tindakan'].'</option>';
            	}
            } else {
            	echo "error";
            } 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo "error";
        }
	}
}
