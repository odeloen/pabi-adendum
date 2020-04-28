<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use File;
use DateTime;

class KeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        try{
            $response = $this->guzzle('GET', 'dashboard_member/'.session('pabi_member_id'), []);
            $response = json_decode($response->getBody()->getContents(), true); 
            $data_member = $response['data'];

            $ob = new PublicController();
            $ob->get_dashboard_member($data_member);

            $response = $this->guzzle('GET', 'pengajuan/history/member/'.$data_member['id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
                //dd($response);
            $data_pengajuan = $response['data'];

            $response = $this->guzzle('POST', 'pengajuan/member/bymember/'.$data_member['id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
                // dd($response['data']);
            $data_pengajuan_pindah_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'menu_keanggotaan');
            session()->put('nama_menu_header', 'Keanggotaan');
            return view('public_admin.keanggotaan.keanggotaan',[
                'nama_menu'=>'menu_keanggotaan'
            ],  compact('data_pengajuan', 'data_member', 'data_pengajuan_pindah_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_member)
    {
        return view('public_admin.keanggotaan.modal_ubah', compact('id_member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
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

    function guzzleMultipart($method, $url, $form)
    {
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

    public function div_identitas_diri_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/kabupaten', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kota = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $id_prov_member = 0;
            //-- START ambil id prov --
            $kabupaten_by_id = null;            
            if ($data_member['kota'] !== null) {
                $response = $this->guzzle('GET', 'wilayah/kabupaten/'.$data_member['kota'], []);
                $response = json_decode($response->getBody()->getContents(), true);
                $kabupaten_by_id = $response['data'];
            }
            
            $kab_by_prov = null;
            if ($kabupaten_by_id !== null) {
                $id_prov_member = $kabupaten_by_id['id_prov'];

                $response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$id_prov_member, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $kab_by_prov = $response['data'];
            }
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_identitas_diri_keanggotaan', compact('data_member', 'data_kota', 'data_provinsi', 'id_prov_member', 'kab_by_prov'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_idi_keanggotaan($id)
    {
        try{ 
            // $response = $this->guzzle('GET', 'wilayah/kabupaten', []);
            // $response = json_decode($response->getBody()->getContents(), true);
            // $data_kota = $response['data'];

            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            // $response = $this->guzzle('GET', 'user/detail/'.$data_member['user_id'], []);
            // $response = json_decode($response->getBody()->getContents(), true);
            // $data_user = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_data_idi_keanggotaan', compact('data_member', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_foto_profile_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];
            return view('public_admin.keanggotaan.div_foto_profile_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_pasangan_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/kabupaten', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kota = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            return view('public_admin.keanggotaan.div_data_pasangan_keanggotaan', compact('data_member', 'data_kota', 'data_provinsi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_pasangan_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'pasangan/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pasangan = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_pasangan_keanggotaan', compact('data_pasangan', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_anak_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/kabupaten', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kota = $response['data'];

            return view('public_admin.keanggotaan.div_data_anak_keanggotaan', compact('data_member', 'data_kota'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_anak_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'anak/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_anak = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_anak_keanggotaan', compact('data_anak', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_pendidikan_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.keanggotaan.div_data_pendidikan_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_pendidikan_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'pendidikan/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pendidikan = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_pendidikan_keanggotaan', compact('data_pendidikan', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_minat_bidang_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']; 

            $response = $this->guzzle('GET', 'minat-bidang/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_minat_bidang = $response['data'];

            return view('public_admin.keanggotaan.div_minat_bidang_keanggotaan', compact('data_member', 'data_minat_bidang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_minat_bidang_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'minat-bidang/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_minat_bidang = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_minat_bidang_keanggotaan', compact('data_minat_bidang', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_ujian_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.keanggotaan.div_data_ujian_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_ujian_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'ujian/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_ujian = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_ujian_keanggotaan', compact('data_ujian', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    // --- Start Tambahan Baru ---

    public function div_data_jurnal_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.keanggotaan.div_data_jurnal_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_jurnal_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'jurnal/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_jurnal = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_jurnal_keanggotaan', compact('data_jurnal', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }



    public function div_data_file_keanggotaan($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.keanggotaan.div_data_file_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_data_file_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'file/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_file = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_file_keanggotaan', compact('data_file', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_data_bank_keanggotaan($id)
    {
        try{  
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']; 
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_data_bank_keanggotaan', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }
    // --- Finish Tambahan Baru ---


    public function div_pekerjaan_keanggotaan($id)
    {
        try{  
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'pekerjaan/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pekerjaan = $response['data'];


            // dd($data_pekerjaan);
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_pekerjaan_keanggotaan', compact('data_member', 'data_pekerjaan'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($id); 
        }
        
    }

    public function div_tabel_data_pekerjaan_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'pekerjaan/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pekerjaan = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_pekerjaan_keanggotaan', compact('data_pekerjaan', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_praktek_keanggotaan($id)
    {
        try{  
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            // $response = $this->guzzle('GET', 'pekerjaan/member/'.$id, []);
            // $response = json_decode($response->getBody()->getContents(), true);
            // $data_praktek = $response['data'];
            $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];

            


            // dd($data_pekerjaan);
            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_praktek_keanggotaan', compact('data_member', 'data_rs'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($id); 
        }
        
    }

    public function div_tabel_data_praktek_keanggotaan(Request $request, $id)
    {
        try{ 
            $view = $request->view;
            $response = $this->guzzle('GET', 'praktek/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_praktek = $response['data'];
            return view('public_admin.keanggotaan.div_tabel_data_praktek_keanggotaan', compact('data_praktek', 'view'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_nomor_anggota_pabi($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_nomor_anggota_pabi', compact('data_member', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_data_ujian_keanggotaan_ubah($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'ujian/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_ujian = $response['data'];

            return view('public_admin.keanggotaan.div_data_ujian_keanggotaan_ubah', compact('data_ujian'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }
    
    public function div_periode_poin_member($id)
    {
        $member_id = $id;
        try{ 
            $response = $this->guzzle('POST', 'borang/kredit-poin/periode', [
                'member_id' => $id
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_periode_poin = $response['data'][0];

            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_periode_poin_member', compact('data_periode_poin', 'member_id'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }

    public function div_nomor_pabi_sejahtera($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.keanggotaan.div_nomor_pabi_sejahtera', compact('data_member', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
        
    }
}
