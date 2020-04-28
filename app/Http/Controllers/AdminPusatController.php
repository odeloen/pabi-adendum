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

class AdminPusatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try{

            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_admin_pusat');
            session()->put('nama_menu_header', 'Master Admin Pusat');
            return view('public_admin.master_admin_pusat.master_admin_pusat',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_admin_pusat'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    }

    public function modal_tambah()
    {
        //  
        try{

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];
            return view('public_admin.master_admin_pusat.modal_tambah', compact('data_provinsi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response['info']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
         try{
            $response = $this->guzzle('POST','admin/pusat/create',[
                'name' =>  $request->nama,
                'description' => $request->deskripsi, 
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation, 
                'email' => $request->email,
                'nama_bank' => $request->nama_bank,
                'no_rek' => $request->no_rek, 
                'pemilik_rek' => $request->pemilik_rek
            ]);

            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);   
            return redirect('admin/master_admin_pusat');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_admin_pusat');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_admin_pusat(Request $request,$id){
        try{
            $response = $this->guzzle('POST','admin/pusat/update/'.$id,[
                'name' => $request->nama_admin,
                'description' => $request->description,
                'nama_bank' => $request->nama_bank,
                'no_rek' => $request->no_rek, 
                'pemilik_rek' => $request->pemilik_rek
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);   
            return redirect('admin/master_admin_pusat');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_admin_pusat');
        }
    }
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
        try{
            $response = $this->guzzle('POST', 'admin/pusat/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function modal_edit($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'admin/pusat/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];


            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];
            //print_r($data_kota); 
            return view('public_admin.master_admin_pusat.modal_edit_pusat', compact('data_admin_pusat', 'data_provinsi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        } 
    }


    // START MASTER DATA
    public function master_rumah_sakit_page()
    {
         try{
            if (session('pabi_role_id') == 2) {
                $response = $this->guzzle('POST', 'rumah-sakit/not-member/not-auth/req/show', [
                    'admin_pusat_id' => session('admin_pusat_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_rs = $response['data'];
            } else if (session('pabi_role_id') == 3) {
                $response = $this->guzzle('POST', 'rumah-sakit/not-member/not-auth/req/show', [
                    'admin_cabang_id' => session('admin_cabang_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_rs = $response['data'];
            } else {
                $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth', []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_rs = $response['data'];
            }
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_rumah_sakit_page');
            session()->put('nama_menu_header', 'Master Rumah Sakit');
            return view('public_admin.master_rumah_sakit.master_rumah_sakit',[
                    'nama_menu' => 'master_rumah_sakit_page'
            ], compact('data_rs'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    }
    public function master_rumah_sakit_hapus($id)
    { 
        try{
            $response = $this->guzzle('POST', 'rumah-sakit/not-member/not-auth/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }
    public function tambah_modal_rumah_sakit()
    { 
         try{
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_cabang = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];
            //print_r($data_kota);             

            return view('public_admin.master_rumah_sakit.modal_tambah',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_provinsi', 'data_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }  
    }
    public function edit_modal_rumah_sakit($id)
    { 
        try{ 
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_rs = $response['data'];
            // dd($data_rs);
            // echo $data_rs['id_provinsi']; exit();
            $response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$data_rs['id_provinsi'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kab = $response['data'];
            //print_r($data_kota);             

            return view('public_admin.master_rumah_sakit.modal_edit',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_provinsi', 'data_rs', 'data_kab'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function edit_modal_akun_rs($id)
    { 
        try{ 
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_cabang = $response['data'];

            $response = $this->guzzle('GET', 'user/detail/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_user_rs = $response['data'];

            return view('public_admin.master_rumah_sakit.modal_edit_akun',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_cabang', 'data_user_rs'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function reset_password_rs($id)
    { 
        $user_id = $id;
        return view('public_admin.master_rumah_sakit.modal_ubah_password',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('user_id'));
    }

    public function simpan_edit_modal_akun_rs(Request $request, $id)
    { 
        try{
            $response = $this->guzzle('POST','user/update/'.$id,[
                'username' => $request->username,
                'email' => $request->email,
                'admin_cabang_id' => $request->admin_cabang_id,
                'admin_pusat_id' => $request->admin_pusat_id
            ]); 
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
            if ($request->has('halaman') && !empty($request->halaman) && $request->halaman == 'profile') {
                session()->put('status', 'Data Akun Berhasil Diubah');
                return redirect('logout'); 
            } else {
                return redirect('admin/master_rumah_sakit_page');
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
            if ($request->has('halaman') && !empty($request->halaman) && $request->halaman == 'profile') {
                return redirect('rumah-sakit/myprofile');
            } else {
                return redirect('admin/master_rumah_sakit_page');
            }
        }
    }

    public function simpan_reset_password_rs(Request $request, $id)
    { 
        try{
            $response = $this->guzzle('POST', 'user/password/reset/da5dd030f42f510eee96b6b9245462ad/user/'.$id, [
                'new_password' => $request->password,
                'new_password_confirmation' => $request->password_confirmation
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
            return redirect('admin/master_rumah_sakit_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_rumah_sakit_page');
        }
    }

    public function simpan_rumah_sakit(Request $request)
    { 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array(
            [
                'name' => 'nama',
                'contents' => $request->nama
            ],
            [
                'name' => 'telpon',
                'contents' => $request->telpon
            ],
            [
                'name' => 'alamat',
                'contents' => $request->alamat
            ],
            [
                'name' => 'id_provinsi',
                'contents' => $request->prov_id
            ],
            [
                'name' => 'id_kabupaten_kota',
                'contents' => $request->kota_id
            ],
            [
                'name' => 'username',
                'contents' => $request->username
            ],
            [
                'name' => 'email',
                'contents' => $request->email
            ],
            [
                'name' => 'password',
                'contents' => $request->password
            ],
            [
                'name' => 'admin_pusat_id',
                'contents' => $request->admin_pusat_id
            ],
            [
                'name' => 'admin_cabang_id',
                'contents' => $request->admin_cabang_id
            ] 
        );
        if(!empty($request->file('img_logo'))){
            $tgl = new DateTime();
            $r = $request->file('img_logo');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'img_logo',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        try{ 
            $response = $this->guzzleMultipart('POST','rumah-sakit/not-member/not-auth/create', $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_rumah_sakit_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_rumah_sakit_page');
        }
    }

    public function simpan_edit_rumah_sakit(Request $request )
    { 
        $id = $request->id;
        
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'nama',
                    'contents' => $request->nama
                ],
                [
                    'name' => 'telpon',
                    'contents' => $request->telpon
                ],
                [
                    'name' => 'alamat',
                    'contents' => $request->alamat
                ],
                [
                    'name' => 'id_provinsi',
                    'contents' => $request->prov_id
                ],
                [
                    'name' => 'id_kabupaten_kota',
                    'contents' => $request->kota_id
                ] );
        if(!empty($request->file('img_logo'))){
            $tgl = new DateTime();
            $r = $request->file('img_logo');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'img_logo',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        try{ 
            $response = $this->guzzleMultipart('POST','rumah-sakit/not-member/not-auth/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            if ($request->has('halaman') && !empty($request->halaman) && $request->halaman == 'profile') {

                $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth/'.session('pabi_rs_id'), []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_rs = $response['data'];
                
                session([
                    'pabi_image' => $data_rs['img_logo']
                    , 'pabi_image_compress' => $data_rs['img_logo']
                ]);

                session()->put('status', 'Data Akun Berhasil Diubah');
                return redirect('rumah-sakit/myprofile');
            } else {
                return redirect('admin/master_rumah_sakit_page');
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            if ($request->has('halaman') && !empty($request->halaman) && $request->halaman == 'profile') {
                return redirect('rumah-sakit/myprofile');
            } else {
                return redirect('admin/master_rumah_sakit_page');
            }
        }
    }

    //START MASTER MINAT BIDANG
    public function master_minat_bidang_page()
    {
         try{

            $response = $this->guzzle('GET', 'minat-bidang/not-member/not-auth', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_minat_bidang = $response['data'];
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_minat_bidang_page');
            session()->put('nama_menu_header', 'Master Minat Bidang');
            return view('public_admin.master_minat_bidang.master_minat_bidang',[
                    'nama_menu' => 'master_minat_bidang_page'
            ], compact('data_minat_bidang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    }
    public function tambah_modal_minat_bidang()
    {  
            return view('public_admin.master_minat_bidang.modal_tambah',[
                    'nama_menu' => 'master_minat_bidang'
            ]); 
    }
    public function simpan_minat_bidang(Request $request)
    {   
        $data = array([
                    'name' => 'nama',
                    'contents' => $request->nama
                ],
                [
                    'name' => 'kode',
                    'contents' => $request->kode
                ]
            );  
        try{ 
            $response = $this->guzzleMultipart('POST','minat-bidang/not-member/not-auth/create', $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_minat_bidang_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_minat_bidang_page');
        }
    }
    public function edit_modal_minat_bidang($id)
    { 
        try{  

            $response = $this->guzzle('GET', 'minat-bidang/not-member/not-auth/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_minat_bidang = $response['data']; 
            //print_r($data_kota);             

            return view('public_admin.master_minat_bidang.modal_edit',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_minat_bidang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }
    public function simpan_edit_minat_bidang(Request $request )
    { 
        $id = $request->id;
         
        $data = array([
                    'name' => 'nama',
                    'contents' => $request->nama
                ],
                [
                    'name' => 'kode',
                    'contents' => $request->kode
                ]);  
        try{ 
            $response = $this->guzzleMultipart('POST','minat-bidang/not-member/not-auth/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_minat_bidang_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_minat_bidang_page');
        }
    } 

    public function master_minat_bidang_hapus($id)
    { 
        try{
            $response = $this->guzzle('POST', 'minat-bidang/not-member/not-auth/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    // END MINAT BIDANG

    // START BANNER 
    public function master_banner_page()
    {
         try{

            $response = $this->guzzle('GET', 'master/banner', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_banner = $response['data'];
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_banner_page');
            session()->put('nama_menu_header', 'Master Banner');
            return view('public_admin.master_banner.master_banner',[
                    'nama_menu' => 'master_banner_page'
            ], compact('data_banner'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    }

    public function tambah_modal_banner()
    {  
            return view('public_admin.master_banner.modal_tambah',[
                    'nama_menu' => 'master_banner'
            ]); 
    }

    public function simpan_banner(Request $request)
    { 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'posisi_isi',
                    'contents' => $request->posisi_isi
                ]);
        if(!empty($request->file('image_banner'))){
            $tgl = new DateTime();
            $r = $request->file('image_banner');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_banner',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_banner_compress'))){
            $tgl = new DateTime();
            $r = $request->file('image_banner_compress');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_banner_compress',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }



        try{ 
            $response = $this->guzzleMultipart('POST','master/banner/create', $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_banner_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_banner_page');
        }
    }

    public function edit_modal_banner($id)
    { 
        try{  

            $response = $this->guzzle('GET', 'master/banner/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_banner = $response['data']; 
            //print_r($data_kota);             

            return view('public_admin.master_banner.modal_edit',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_banner'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function simpan_edit_banner(Request $request )
    { 
        $id = $request->id; 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'posisi_isi',
                    'contents' => $request->posisi_isi
                ]);
        if(!empty($request->file('image_banner'))){
            $tgl = new DateTime();
            $r = $request->file('image_banner');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_banner',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_banner_compressor'))){
            $tgl = new DateTime();
            $r = $request->file('image_banner_compressor');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_banner_compressor',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        try{ 
            $response = $this->guzzleMultipart('POST','master/banner/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_banner_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_banner_page');
        }
    }

    public function master_banner_hapus($id)
    { 
        try{
            $response = $this->guzzle('POST', 'master/banner/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }
    // END BANNER

    // START BERITA
    public function master_berita_page()
    {
         try{ 
            $response = $this->guzzle('GET', 'master/berita', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_berita = $response['data'];
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_berita_page');
            session()->put('nama_menu_header', 'Master Berita');
            return view('public_admin.master_berita.master_berita',[
                    'nama_menu' => 'master_berita_page'
            ], compact('data_berita'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    } 

    public function tambah_modal_berita()
    {  
        return view('public_admin.master_berita.modal_tambah',[
                'nama_menu' => 'master_berita'
        ]); 
    }

    public function simpan_berita(Request $request)
    { 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'is_top',
                    'contents' => $request->is_top
                ]
            );
        if(!empty($request->file('image_berita'))){
            $tgl = new DateTime();
            $r = $request->file('image_berita');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_berita',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_berita_compressor'))){
            $tgl = new DateTime();
            $r = $request->file('image_berita_compressor');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_berita_compressor',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }



        try{ 
            $response = $this->guzzleMultipart('POST','master/berita/create', $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_berita_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_berita_page');
        }
    }

    public function edit_modal_berita($id)
    { 
        try{  

            $response = $this->guzzle('GET', 'master/berita/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_berita = $response['data']; 
            //print_r($data_kota);             

            return view('public_admin.master_berita.modal_edit',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_berita'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }
     public function simpan_edit_berita(Request $request )
    { 
        $id = $request->id; 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'is_top',
                    'contents' => $request->is_top
                ] 
            );
        if(!empty($request->file('image_berita'))){
            $tgl = new DateTime();
            $r = $request->file('image_berita');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_berita',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_berita_compressor'))){
            $tgl = new DateTime();
            $r = $request->file('image_berita_compressor');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_berita_compressor',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        try{ 
            $response = $this->guzzleMultipart('POST','master/berita/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_berita_page');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_berita_page');
        }
    }
    
    public function master_berita_hapus($id)
    { 
        try{
            $response = $this->guzzle('POST', 'master/berita/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }
    // END BERITA

    // START TENTANG PABI  
    public function master_tentang_pabi()
    {
         try{ 
            $response = $this->guzzle('GET', 'master/tentang-pabi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_tentang_pabi = $response['data'];

            $response = $this->guzzle('GET', 'setting/landing-page/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_dashboard = $response['data']; 

            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $kab_by_prov = null;
            if ($data_dashboard['provinsi_id'] !== null) {
                $id_prov_member = $data_dashboard['provinsi_id'];

                $response = $this->guzzle('GET', 'wilayah/kabupaten/provinsi/'.$id_prov_member, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $kab_by_prov = $response['data'];
            }
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_tentang_pabi');
            session()->put('nama_menu_header', 'Tentang PABI');
            return view('public_admin.master_tentang_pabi.master_tentang_pabi',[
                    'nama_menu' => 'master_tentang_pabi'
            ], compact('data_dashboard'
                    , 'data_provinsi'
                    , 'kab_by_prov'
                    , 'data_tentang_pabi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        } 
    } 


    public function tambah_modal_tentang_pabi()
    {  
            return view('public_admin.master_tentang_pabi.modal_tambah',[
                    'nama_menu' => 'master_tentang_pabi'
            ]); 
    }

    public function simpan_tentang_pabi(Request $request)
    { 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'posisi_isi',
                    'contents' => $request->posisi_isi
                ]);
        if(!empty($request->file('image'))){
            $tgl = new DateTime();
            $r = $request->file('image');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_compress'))){
            $tgl = new DateTime();
            $r = $request->file('image_compress');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_compress',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }



        try{ 
            $response = $this->guzzleMultipart('POST','master/tentang-pabi/create', $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            // dd($response);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
    }

    public function edit_modal_tentang_pabi($id)
    { 
        try{  

            $response = $this->guzzle('GET', 'master/tentang-pabi/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_tentang_pabi = $response['data'];
            //print_r($data_kota);             

            return view('public_admin.master_tentang_pabi.modal_edit',[
                    'nama_menu' => 'master_admin_pusat'
            ], compact('data_tentang_pabi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function simpan_edit_tentang_pabi(Request $request )
    { 
        $id = $request->id; 
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'judul',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'isi',
                    'contents' => $request->isi
                ],
                [
                    'name' => 'posisi_isi',
                    'contents' => $request->posisi_isi
                ]);
        if(!empty($request->file('image'))){
            $tgl = new DateTime();
            $r = $request->file('image');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        if(!empty($request->file('image_compressor'))){
            $tgl = new DateTime();
            $r = $request->file('image_compressor');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();

            array_push($data,
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image_compressor',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r')
                ]);
        }

        try{ 
            $response = $this->guzzleMultipart('POST','master/tentang-pabi/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
    }

    public function master_tentang_pabi_hapus($id)
    { 
        try{
            $response = $this->guzzle('POST', 'master/tentang-pabi/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function simpan_edit_landing_page_pabi(Request $request, $id )
    { 
        $response = $this->guzzle('GET', 'wilayah/kabupaten/'.$request->tent_kota, []);
        $response = json_decode($response->getBody()->getContents(), true);
        $nama_kota = $response['data'];

        $response = $this->guzzle('GET', 'wilayah/provinsi/'.$request->tent_provinsi, []);
        $response = json_decode($response->getBody()->getContents(), true);
        $nama_provinsi = $response['data'];
        // echo $nama_provinsi['nama']; exit();
        $path = null;
        $org = null;
        $mime = null; 
        $data = array([
                    'name' => 'alamat',
                    'contents' => $request->tent_alamat
                ]
                , [
                    'name' => 'kota',
                    'contents' => $nama_kota['nama']
                ]
                , [
                    'name' => 'kota_id',
                    'contents' => $request->tent_kota
                ]
                , [
                    'name' => 'provinsi',
                    'contents' => $nama_provinsi['nama']
                ]
                , [
                    'name' => 'provinsi_id',
                    'contents' => $request->tent_provinsi
                ]
                , [
                    'name' => 'email',
                    'contents' => $request->tent_email
                ]
                , [
                    'name' => 'no_telp',
                    'contents' => $request->tent_no_telp
                ]
                , [
                    'name' => 'no_deskripsi',
                    'contents' => $request->tent_no_deskripsi
                ]
                , [
                    'name' => 'facebook',
                    'contents' => $request->tent_link_facebook
                ]
                , [
                    'name' => 'instagram',
                    'contents' => $request->tent_link_instagram
                ]
                , [
                    'name' => 'twitter',
                    'contents' => ''
                ]
                , [
                    'name' => 'google_plus',
                    'contents' => ''
                ]
            ); 

        try{ 
            $response = $this->guzzleMultipart('POST','setting/landing-page/update/'.$id, $data);
            $response = json_decode($response->getBody()->getContents(), true);
            // dd($response);
            session()->put('status', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true); 
            session()->put('statusT', $response['info']);
            return redirect('admin/master_tentang_pabi');
        }
    }
    // END TENTANG PABI
    // END MASTER DATA 


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

    function status_response($status)
    {
        if($status == '401') {
            $message = "Silahkan Login Kembali";
            return redirect('login')->withErrors($message);
        }
    }
}
