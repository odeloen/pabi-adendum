<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use File;
use DateTime;

class ProfileController extends Controller
{
    public function my_profile_member()
    {
        try{
            $response = $this->guzzle('GET', 'member/'.session('pabi_member_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
                //dd($response);
            $data_member = $response['data'];
                //dd($data_member);

            $response = $this->guzzle('GET', 'user/detail/'.session('pabi_user_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
                //dd($response);
            $data_user = $response['data'];


            session()->put('nama_menu_sidebar', 'menu_profile');
            session()->put('nama_menu_header', 'My Profile');
            return view('public_admin.profile.my_profile_member',  
                compact('data_member', 'data_user'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function my_profile_rs()
    {
        try{
            $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth/'.session('pabi_rs_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

            $response = $this->guzzle('GET', 'user/detail/'.session('pabi_user_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_user = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$data_rs['id_provinsi'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kab = $response['data'];

            session()->put('nama_menu_sidebar', 'menu_profile');
            session()->put('nama_menu_header', 'My Profile');
            return view('public_admin.profile.my_profile_rs',  
                compact('data_rs', 'data_user', 'data_provinsi', 'data_kab'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function my_profile_admin()
    {
        try{
            $data_admin = null;
            $admin_id = 0;
            $url_test = 'user/detail/';
            if (session('pabi_role_id') == 2) {
                $admin_id = session('admin_pusat_id');
                $url_test = 'admin/pusat/';
            } else if (session('pabi_role_id') == 3) {
                $admin_id = session('admin_cabang_id');
                $url_test = 'admin/cabang/';
            }
            if (session('pabi_role_id') != 1) {
                $response = $this->guzzle('GET', $url_test.$admin_id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_admin = $response['data'];
            }

            $response = $this->guzzle('GET', 'user/detail/'.session('pabi_user_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
                //dd($response);
            $data_user = $response['data'];

            session()->put('nama_menu_sidebar', 'menu_profile');
            session()->put('nama_menu_header', 'My Profile');
            return view('public_admin.profile.my_profile_admin', compact('data_admin', 'data_user'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function edit()
    {   
        try{
            $id_member = session('pabi_member_id');
            return view('public_admin.profile.modal_ubah', compact('id_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function set_kota_by_prov(Request $request)
    {   
        try{
            $response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$request->id_prov, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kota = $response['data'];
            echo '<option value="">-- Select Kota Tinggal--</option>';
            foreach ($data_kota as $key) {
                echo '<option value="'.$key['id'].'">'.$key['nama'].'</option>';
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function simpan_ubah_my_profile_identitas_diri(Request $request, $id)
    {   
        //echo $request->tgl_lahir.$request->nickname; exit();
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('POST','member/update/'.$id,[
                'user_id' => $data_member['user_id'],
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'nickname' => $request->nickname,
                'gelar' => $request->gelar,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'alamat_rumah' => $request->alamat_rumah,
                'kota' => $request->kota,
                'no_telp' => $request->no_telp, 
                'no_hp' => $request->no_hp, 
                'hobi' => $request->hobi
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }



    public function simpan_ubah_my_profile_bank(Request $request, $id)
    {   
        //echo $request->tgl_lahir.$request->nickname; exit();
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('POST','member/update/'.$id,[
                'user_id' => $data_member['user_id'],
                'bank_nama' => $request->nama_bank,
                'bank_pemilik' => $request->nama_pemilik_rekening,
                'bank_no_rekening' => $request->nomor_rekening 
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function simpan_ubah_my_profile_foto_profile(Request $request, $id)
    {   
        $tgl = new DateTime();
        $r = $request->file('image_thumb');
        $path = $r->getPathname();
        $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
        $mime = $r->getmimeType();

        if($_FILES['image_thumb']['size'] >= 900000)
        {
            $message = 'File Terlalu Besar';
            // dd($response);
            session()->put('statusT', $message);
            return redirect('member/keanggotaan');
        } else { 
            try{
                $response = $this->guzzle('GET', 'member/'.$id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];

                $response = $this->guzzleMultipart('POST','member/update/'.$id, [
                    [
                        'name' => 'user_id',
                        'contents' => $data_member['user_id']
                    ],
                    [
                        'Content-type' => 'multipart/form-data',
                        'name' => 'image_thumb',
                        'filename' => $org,
                        'Mime-Type'=> $mime,
                        'contents' => fopen($path, 'r' )
                    ]
                ]);
                $response = json_decode($response->getBody()->getContents(), true);

                $response = $this->guzzle('GET', 'dashboard_member/'.session('pabi_member_id'), []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data']; 

                $ob = new PublicController();
                $ob->get_dashboard_member($data_member);
                
                session()->put('status', 'Foto berhasil di upload');
                return redirect('member/keanggotaan');
            }
            catch(RequestException $e){
                $response = json_decode($e->getResponse()->getBody()->getContents(),true);
                $message = $response['info'];
                // dd($response);
                return redirect('member/keanggotaan');
            }
        }
    }

    public function hapus_ubah_my_profile_foto_profile(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzleMultipart('POST','member/update/'.$id, [
                [
                    'name' => 'user_id',
                    'contents' => $data_member['user_id']
                ],
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_thumb',
                    'filename' => ""
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            return redirect('member/keanggotaan');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            //dd($response);
            return redirect('member/keanggotaan');
        }
    }

    public function simpan_ubah_my_profile_data_idi(Request $request, $id)
    {   
        //echo $request->admin_pst_id . ' <> ' . $request->admin_cab_id . ' <> ' . $request->card_no . ' <> ' . $request->valid_until_card_no . ' <> ' . $request->no_pabi_sejahtera . ' <> ' . $request->tgl_pabi_sejahtera . ' <> ' . $request->tempat_kerja . ' <> ' . $request->jabatan . ' <> ' . $request->alamat_kantor . ' <> ' . $request->no_str . ' <> ' . $request->sjk_tahun_no_str . ' <> ' . $request->keterangan;
        //exit();
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('POST','member/update/'.$id,[
                'user_id' => $data_member['user_id'],
                'admin_pusat_id' => $request->admin_pst_id,
                'admin_cabang_id' => $request->admin_cab_id,
                'card_no' => $request->card_no,
                'valid_until_card_no' => $request->valid_until_card_no,
                'no_pabi_sejahtera' => $request->no_pabi_sejahtera,
                'tgl_pabi_sejahtera' => $request->tgl_pabi_sejahtera,
                'tempat_kerja' => $request->tempat_kerja,
                'jabatan' => $request->jabatan,
                'alamat_kantor' => $request->alamat_kantor,
                'no_telp_kantor' => $request->no_telp_kantor,
                'no_str' => $request->no_str, 
                'sjk_tahun_no_str' => $request->sjk_tahun_no_str, 

                'no_skk_bedah' => $request->no_skk_bedah, 
                'tgl_skk_bedah' => $request->tgl_skk_bedah, 
                'no_sip_terakhir' => $request->no_sip_terakhir, 
                'tgl_sip_mulai' => $request->tgl_sip_mulai, 
                'tgl_sip_selesai' => $request->tgl_sip_selesai, 

                'keterangan' => $request->keterangan
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function simpan_pengajuan_member($id)
    {   
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'user/detail/'.$data_member['user_id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_user = $response['data'];
            // dd($data_user);
 
            if($data_member['firstname'] === NULL 
                || $data_member['gelar'] === NULL 
                || $data_member['tempat_lahir'] === NULL 
                || $data_member['alamat_rumah'] === NULL 
                || $data_member['tgl_lahir'] === NULL 
                || $data_member['kota'] === NULL 
                || $data_user['admin_cabang_id'] === NULL 
                || $data_member['tempat_kerja'] === NULL 
                || $data_member['alamat_kantor'] === NULL 
                || $data_member['jabatan'] === NULL ){

                session()->put('statusT','Pengajuan gagal, Lengkapi Data Pengajuan'); 
            }else{ 
                $response = $this->guzzle('POST','cabang/verif/update/'.$id,[
                    'cabang_verif' => "1"
                ]); 
                $response = json_decode($response->getBody()->getContents(), true); 
                session()->put('status','Pengajuan berhasil');
                
                $response = $this->guzzle('POST','borang/kredit-poin/periode',[
                    'member_id' => $id
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_borang = $response['data'];

                $tgl = date('Y-m-d');
                $tahun_periode_awal = date('Y');
                $tahun_periode_akhir = date('Y', strtotime('+4 year', strtotime($tgl)));
                if (empty($data_borang)) {
                    $response = $this->guzzle('POST','borang/create',[
                        'member_id' => $id, 
                        'tahun_periode_awal' => $tahun_periode_awal, 
                        'tahun_periode_akhir' => $tahun_periode_akhir
                    ]);
                    $response = json_decode($response->getBody()->getContents(), true);
                    $message = $response['info'];
                }
            }

            return redirect('member/keanggotaan'); 

        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            //dd($response);
            return redirect('member/keanggotaan');
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

    public function ganti_password_admin($id, Request $request)
    {   
        try{
            $response = $this->guzzle('POST','user/password/update/'.$id,[
                'old_password' => $request->old_password,
                'new_password' => $request->new_password,
                'new_password_confirmation' => $request->new_password_confirmation
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);

            return redirect('logout'); 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('admin/myprofile');
        }
    }

    public function ganti_username_email_admin($id, Request $request)
    {   
        try{
            $response = $this->guzzle('POST','user/update/'.$id,[
                'username' => $request->username,
                'email' => $request->email
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);

            return redirect('logout'); 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('admin/myprofile');
        }
    }

    public function ganti_password_member($id, Request $request)
    {   
        try{
            $response = $this->guzzle('POST','user/password/update/'.$id,[
                'old_password' => $request->old_password,
                'new_password' => $request->new_password,
                'new_password_confirmation' => $request->new_password_confirmation
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);

            return redirect('logout'); 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('member/myprofile');
        }
    }

    public function ganti_username_email_member($id, Request $request)
    {   
        try{
            $response = $this->guzzle('POST','user/update/'.$id,[
                'username' => $request->username,
                'email' => $request->email
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);

            $res_error="";
            if(isset($response['errors'])){ 
                if(isset($response['errors']['email'])){
                    foreach ($response['errors']['email'] as $r) { 
                        $res_error=$r;
                    } 
                }
                if(isset($response['errors']['username'])){
                    foreach ($response['errors']['username'] as $r) { 
                        $res_error=$r;
                    } 
                }
                session()->put('statusT', $res_error);
            } else {
                session()->put('status', "Data Berhasil Diubah");
            }
            // print_r($res_error); exit();

            return redirect('member/myprofile');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('member/myprofile');
        }
    }

    public function detail_pengajuan(Request $request){
        $id=$request->id;
        
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']; 
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_detail_pengajuan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function simpan_div_nomor_anggota_pabi(Request $request, $id)
    {   
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $valid_until_card_no = date('Y-m-d', strtotime('+4 year', strtotime($tahun.'-'.$bulan.'-01')));
        $tgl = new DateTime();
        $card_no_issue = $tgl->format('Y-m-d');
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('POST','member/update/'.$id,[
                'user_id' => $data_member['user_id'],
                'card_no' => $request->card_no,
                'valid_until_card_no' => $valid_until_card_no,
                'card_no_issue' => $card_no_issue
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function simpan_div_periode_poin_member(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('POST','borang/update/'.$id,[
                'tahun_periode_awal' => $request->tahun_periode_awal, 
                'tahun_periode_akhir' => $request->tahun_periode_akhir,
                'min_poin' => $request->min_poin
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            echo $response['message'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['message'];
        }
    }

    public function ganti_rekening_admin($id, Request $request)
    {   
        $url = '';
        if (session('pabi_role_id') == 2) {
            $url = 'pusat';
        } else if (session('pabi_role_id') == 3) {
            $url = 'cabang';
        }
        try{
            $response = $this->guzzle('POST','admin/'.$url.'/update/'.$id,[
                'nama_bank' => $request->nama_bank,
                'no_rek' => $request->no_rek,
                'pemilik_rek' => $request->pemilik_rek
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', 'Data Rekening Berhasil Di Ubah');
            return redirect('admin/myprofile'); 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('admin/myprofile');
        }
    }

    public function simpan_div_nomor_pabi_sejahtera(Request $request, $id)
    {   
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $valid_until_card_no = date('Y-m-d', strtotime('+4 year', strtotime($tahun.'-'.$bulan.'-01')));
        $tgl = new DateTime();
        $tgl_pabi_sejahtera = $tgl->format('Y-m-d');
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('POST','member/update/'.$id,[
                'user_id' => $data_member['user_id'],
                'no_pabi_sejahtera' => $request->no_pabi_sejahtera,
                'tgl_pabi_sejahtera' => $tgl_pabi_sejahtera
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function add_div_periode_poin_member(Request $request)
    {   
        try{
            $response = $this->guzzle('POST','borang/create',[
                'member_id' => $request->member_id, 
                'tahun_periode_awal' => $request->tahun_periode_awal, 
                'tahun_periode_akhir' => $request->tahun_periode_akhir,
                'min_poin' => $request->min_poin
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['message'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['message'];
        }
    }

    public function ganti_password_rs($id, Request $request)
    {   
        try{
            $response = $this->guzzle('POST','user/password/update/'.$id,[
                'old_password' => $request->old_password,
                'new_password' => $request->new_password,
                'new_password_confirmation' => $request->new_password_confirmation
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);

            return redirect('logout'); 
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']); 
            return redirect('rumah-sakit/myprofile');
        }
    }
}
