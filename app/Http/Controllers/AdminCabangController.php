<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Support\Guzzle\GuzzleConfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;

class AdminCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try{

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];
            //print_r($data_kota);            

            session()->put('nama_menu_sidebar', 'master_admin_cabang');
            session()->put('nama_menu_header', 'Master Admin Cabang');
            return view('public_admin.master_admin_cabang.master_admin_cabang',[
                'nama_menu' => 'master_admin_cabang'
            ], compact('data_admin_cabang'));
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
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];
            return view('public_admin.master_admin_cabang.modal_tambah', compact('data_admin_pusat'));
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
        //dd($request->admin_pst_id);
        try{
            $response = $this->guzzle('POST','admin/cabang/create',[
                'name' =>  $request->nama,
                'description' => $request->deskripsi,
                'admin_pusat_id' => $request->admin_pst_id, 
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation, 
                'email' => $request->email,
                'nama_bank' => $request->nama_bank,
                'no_rek' => $request->no_rek, 
                'pemilik_rek' => $request->pemilik_rek
            ]);

            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);   
            return redirect('admin/master_admin_cabang');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', 'Gagal');
            return redirect('admin/master_admin_cabang');
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

    public function update_admin_cabang(Request $request,$id){
        try{
            $response = $this->guzzle('POST','admin/cabang/update/'.$id,[
                'name' => $request->nama_admin,
                'description' => $request->description,
                'nama_bank' => $request->nama_bank,
                'no_rek' => $request->no_rek, 
                'pemilik_rek' => $request->pemilik_rek
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);   
            return redirect('admin/master_admin_cabang');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_admin_cabang');
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
            $response = $this->guzzle('POST', 'admin/cabang/delete/'.$id, []);
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
            $response = $this->guzzle('GET', 'admin/cabang/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];


            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];
            //print_r($data_kota); 
            return view('public_admin.master_admin_cabang.modal_edit_cabang', compact('data_admin_cabang', 'data_provinsi'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
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

    function status_response($status)
    {
        if($status == '401') {
            $message = "Silahkan Login Kembali";
            return redirect('login')->withErrors($message);
        }
    }

    public function admin_cabang_by_admin_pusat(Request $request){
        try{
            $response = $this->guzzle('GET','admin/cabang-pusat/'.$request->admin_pusat_id,[]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            echo '<option value="">-- Semua --</option>';
            foreach ($data_admin_cabang as $dac) {
                echo '<option value="'.$dac['id'].'">'.$dac['name'].'</option>';
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }
}
