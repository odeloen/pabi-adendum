<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Support\Guzzle\GuzzleConfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use App\Model\MasterBerita;
use App\Model\Pusat;
use App\Model\Cabang;
use App\Model\MinatBidang;
use App\Model\Member;
use App\Model\MasterTentangPabi;
use DateTime;

class PublicDokterController extends Controller
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

    function status_response($status)
    {
        if($status == '401') {
            $message = "Silahkan Login Kembali";
            return redirect('login')->withErrors($message);
        }
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

    public function list_dokter()
    {
        $data_dashboard = DB::table('setting_landing_page')
            ->select('setting_landing_page.*'
                , DB::raw('(SELECT count(*) FROM members WHERE pusat_verif=2 and is_non_aktif=1) as jml_dokter')
                , DB::raw('(select count(*) from admin_cabang ) as jml_kota')
                , DB::raw('(select count(*) from kabupaten ) as jml_kota_all')
            )
            ->where('id', '=', 1)
            ->get();
        foreach ($data_dashboard as $data_dashboard) {}
        $data_admin_cabang = Cabang::all()->sortBy('name');
        $data_minat_bidang = MinatBidang::all();

        //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
        return view('public_member.master_dokter.master_dokter', compact('data_admin_cabang', 'data_minat_bidang', 'data_dashboard')); 
    }

    public function detail_per_dokter(Request $request)
    { 
        $data_dashboard = DB::table('setting_landing_page')
            ->select('setting_landing_page.*'
                , DB::raw('(SELECT count(*) FROM members WHERE pusat_verif=2 and is_non_aktif=1) as jml_dokter')
                , DB::raw('(select count(*) from admin_cabang ) as jml_kota')
                , DB::raw('(select count(*) from kabupaten ) as jml_kota_all')
            )
            ->where('id', '=', 1)
            ->get();
        foreach ($data_dashboard as $data_dashboard) {}
    	try { 
            $response = $this->guzzle('GET', 'public/member/'.$request->member_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_dokter = $response['data_member'][0];
            $data_minat_bidang = $response['data_minat_bidang'];
            $data_pekerjaan = $response['data_pekerjaan'];
            $data_pendidikan = $response['data_pendidikan'];
            $data_praktek = $response['data_praktek'];

            //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
            return view('public_member.master_dokter.detail_per_dokter'
                , compact('data_dashboard', 'data_dokter', 'data_minat_bidang', 'data_pekerjaan', 'data_pendidikan', 'data_praktek'));
        }
        catch(RequestException $e) {
            $data_dashboard = array('alamat' => 'Jl. Kalibokor 71, Surabaya'
                            , 'email' => 'pp_pabi@yahoo.com' 
                            , 'no_telp' => '031-5027571'
                        );
            return view('public_member.master_dokter.detail_per_dokter'
                , compact('data_dashboard'));
            // $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            // dd($response);
        }
    }

    public function div_public_tabel_master_dokter(Request $request)
    {
        //dd($request); Djonny Ferianto S.Pualilin
        // WI-KRW-12-18-0314 dr Djoni Darmadjaja
        // CI-SUB-12-18-0003 dr Paul
        // CI-SUB-12-18-0009 dr Urip
        // EI-DPS-12-18-0008 dr I nengah


        // ->orderByRaw(' card_no != \'CI-SUB-12-18-0009\' 
        //             , card_no != \'EI-UPG-06-19-2890\' 
        //             , card_no != \'CI-SUB-12-18-0003\' 
        //             , card_no != \'EI-DPS-12-18-0008\' 

        $member = Member::leftJoin('kabupaten as k', 'k.id', '=', 'members.kota')
            ->leftJoin('kabupaten as t', 't.id', '=', 'members.tempat_lahir')
            ->leftJoin('users as u', 'u.id', '=', 'members.user_id')
            ->select(['members.*', 'u.admin_cabang_id', 'k.nama as nama_kota_kota', 't.nama as nama_kota_tempat_lahir'])
            ->orderByRaw(' firstname != \'Urip Murtedjo\' 
                        , firstname != \'Djoni Darmadjaja\' 
                        , firstname != \'I Nengah Kuning Atmadjaya\' 
                        , firstname != \'Prof. Dr. Paul Tahalele\'  
                    , firstname asc')
            ->where('pusat_verif', 2);
        
        if(!empty($request->nama_dokter)) {
            // $member->where(DB::raw('CONCAT(members.firstname, members.lastname, members.nickname)'), 'like', '%'.$request->nama_dokter.'%');
            $member->whereRaw("
                (
                    members.firstname like '%".$request->nama_dokter."%' 
                    or members.lastname like '%".$request->nama_dokter."%' 
                    or members.nickname like '%".$request->nama_dokter."%'   
                ) ");
        }
        
        if(!empty($request->admin_cabang_id)) {
            $member->where('u.admin_cabang_id', $request->admin_cabang_id);
        }
        
        if(!empty($request->minat_bidang_id)){
            $minat = $request->minat_bidang_id;
            $member->whereIn('members.id', function($query) use ($minat) {
                $query->select('member_id')
                    ->from('member_minat_bidang')
                    ->where('jenis_minat', '=', $minat);
            });
        }
        
        if($request->has('limit')) {
            $member->limit($request->limit);
        }
        $member = $member->get();

        $data_dokter = $member;

        //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
        return view('public_member.master_dokter.div_public_tabel_master_dokter', compact('data_dokter')); 
    }

    public function berita_acara()
    {
        $data_dashboard = DB::table('setting_landing_page')
            ->select('setting_landing_page.*'
                , DB::raw('(SELECT count(*) FROM members WHERE pusat_verif=2 and is_non_aktif=1) as jml_dokter')
                , DB::raw('(select count(*) from admin_cabang ) as jml_kota')
                , DB::raw('(select count(*) from kabupaten ) as jml_kota_all')
            )
            ->where('id', '=', 1)
            ->get();
        foreach ($data_dashboard as $data_dashboard) {}
        $data_berita = MasterBerita::all(); 

        //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
        return view('public_member.menu_dashboard.berita_acara'
            , compact('data_dashboard'
                    , 'data_berita'
                )); 
    }
    public function berita_acara_detail($param_nama, $param_id)
    {
        $param = $this->hamdi_decrypt($param_id, 'progstyle2020'); 
        $id=$param;
        $data_dashboard = DB::table('setting_landing_page')
            ->select('setting_landing_page.*'
                , DB::raw('(SELECT count(*) FROM members WHERE pusat_verif=2 and is_non_aktif=1) as jml_dokter')
                , DB::raw('(select count(*) from admin_cabang ) as jml_kota')
                , DB::raw('(select count(*) from kabupaten ) as jml_kota_all')
            )
            ->where('id', '=', 1)
            ->get();
        foreach ($data_dashboard as $data_dashboard) {}
        $data_berita = MasterBerita::find($id); 

        //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
        return view('public_member.menu_dashboard.berita_acara_detail'
            , compact('data_dashboard'
                    , 'data_berita'
                )
        ); 
    }
    public function tentang_pabi()
    {
        $data_dashboard = DB::table('setting_landing_page')
            ->select('setting_landing_page.*'
                , DB::raw('(SELECT count(*) FROM members WHERE pusat_verif=2 and is_non_aktif=1) as jml_dokter')
                , DB::raw('(select count(*) from admin_cabang ) as jml_kota')
                , DB::raw('(select count(*) from kabupaten ) as jml_kota_all')
            )
            ->where('id', '=', 1)
            ->get();
        foreach ($data_dashboard as $data_dashboard) {}
        $data_tentang_pabi = MasterTentangPabi::all();
    
        //session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
        return view('public_member.menu_dashboard.tentang_pabi'
            , compact('data_dashboard'
                    , 'data_tentang_pabi'
                )
        ); 
    }

    public function hamdi_decrypt($string, $key = '%key&')
    {
        $result = '';
        $string = str_replace("$$@$$", "+", $string);
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $ordChar = ord($char);
            $ordKeychar = ord($keychar);
            $sum = $ordChar - $ordKeychar;
            $char = chr($sum);
            $result .= $char;
        }
        return $result;
    }
}
