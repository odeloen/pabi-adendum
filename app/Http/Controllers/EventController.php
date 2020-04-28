<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use App\Support\Guzzle\GuzzleConfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use DateTime;
use Carbon\Carbon;
use File;
use Mail;
use Alert;
use PDF;

class EventController extends Controller
{
    public function index()
    {
        try{
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'event/pusat/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'master_event_pusat');
            session()->put('nama_menu_header', 'Event');
            return view('public_admin.master_event.sa.master_event',[
                'nama_menu'=>'master_event_pusat'], compact('data_event', 'data_admin_pusat'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function create()
    {
        try{
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'event/jenis/event', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_jenis_event = $response['data'];

            $response = $this->guzzle('GET', 'event/by/jenis-event-id/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_simposium = $response['data'];

            return view('public_admin.master_event.sa.modal_tambah', compact('data_admin_pusat', 'data_provinsi', 'data_jenis_event', 'data_event_simposium'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response['info']);
        }
    }

    public function store(Request $request)
    {
        //dd($request);
        if ($request->file('foto_event') !== null) {
            $tgl = new DateTime();
            $r = $request->file('foto_event');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();
        }
        $nsei = '';
        if ($request->numpang_simposium_event_id !== 'undefined') {
            $nsei = $request->numpang_simposium_event_id;
        }
        try{
            $koordinat = explode(";", $request->kordinat);
            if ($request->file('foto_event') !== null) {
                $response = $this->guzzleMultipart('POST','event/create', [
                    [
                        'name' => 'admin_pusat_id',
                        'contents' => $request->admin_pst_id
                    ],
                    [
                        'name' => 'admin_cabang_id',
                        'contents' => $request->admin_cab_id
                    ],
                    [
                        'name' => 'nama_event',
                        'contents' => $request->nama_event
                    ],
                    [
                        'name' => 'numpang_simposium_event_id',
                        'contents' => $nsei
                    ],
                    [
                        'name' => 'jenis_event_id',
                        'contents' => $request->jenis_event_id
                    ],
                    [
                        'name' => 'nama_bank',
                        'contents' => $request->nama_bank
                    ],
                    [
                        'name' => 'no_rek',
                        'contents' => $request->no_rek
                    ],
                    [
                        'name' => 'pemilik_rek',
                        'contents' => $request->pemilik_rek
                    ],
                    [
                        'name' => 'jenis_event',
                        'contents' => $request->jenis_event
                    ],
                    [
                        'name' => 'tgl_event',
                        'contents' => $request->tgl_event
                    ],
                    [
                        'name' => 'jam_mulai',
                        'contents' => $request->jam_mulai
                    ],
                    [
                        'name' => 'jam_selesai',
                        'contents' => $request->jam_selesai
                    ],
                    [
                        'name' => 'max_event',
                        'contents' => $request->max_event
                    ],
                    [
                        'name' => 'deskripsi',
                        'contents' => $request->deskripsi
                    ],
                    [
                        'name' => 'prov_id',
                        'contents' => $request->prov_id
                    ],
                    [
                        'name' => 'kota_id',
                        'contents' => $request->kota_id
                    ],
                    [
                        'name' => 'kec_id',
                        'contents' => $request->kec_id
                    ],
                    [
                        'name' => 'lokasi_alamat',
                        'contents' => $request->lokasi_alamat
                    ],
                    [
                        'name' => 'lokasi_koordinat_x',
                        'contents' => $koordinat[0]
                    ],
                    [
                        'name' => 'lokasi_koordinat_y',
                        'contents' => $koordinat[1]
                    ],
                    [
                        'Content-type' => 'multipart/form-data',
                        'name' => 'foto_event',
                        'filename' => $org,
                        'Mime-Type'=> $mime,
                        'contents' => fopen($path, 'r')
                    ]
                ]);
            } else {
                $response = $this->guzzleMultipart('POST','event/create', [
                    [
                        'name' => 'admin_pusat_id',
                        'contents' => $request->admin_pst_id
                    ],
                    [
                        'name' => 'admin_cabang_id',
                        'contents' => $request->admin_cab_id
                    ],
                    [
                        'name' => 'nama_event',
                        'contents' => $request->nama_event
                    ],
                    [
                        'name' => 'numpang_simposium_event_id',
                        'contents' => $nsei
                    ],
                    [
                        'name' => 'jenis_event_id',
                        'contents' => $request->jenis_event_id
                    ],
                    [
                        'name' => 'nama_bank',
                        'contents' => $request->nama_bank
                    ],
                    [
                        'name' => 'no_rek',
                        'contents' => $request->no_rek
                    ],
                    [
                        'name' => 'pemilik_rek',
                        'contents' => $request->pemilik_rek
                    ],
                    [
                        'name' => 'jenis_event',
                        'contents' => $request->jenis_event
                    ],
                    [
                        'name' => 'tgl_event',
                        'contents' => $request->tgl_event
                    ],
                    [
                        'name' => 'jam_mulai',
                        'contents' => $request->jam_mulai
                    ],
                    [
                        'name' => 'jam_selesai',
                        'contents' => $request->jam_selesai
                    ],
                    [
                        'name' => 'max_event',
                        'contents' => $request->max_event
                    ],
                    [
                        'name' => 'deskripsi',
                        'contents' => $request->deskripsi
                    ],
                    [
                        'name' => 'prov_id',
                        'contents' => $request->prov_id
                    ],
                    [
                        'name' => 'kota_id',
                        'contents' => $request->kota_id
                    ],
                    [
                        'name' => 'kec_id',
                        'contents' => $request->kec_id
                    ],
                    [
                        'name' => 'lokasi_alamat',
                        'contents' => $request->lokasi_alamat
                    ],
                    [
                        'name' => 'lokasi_koordinat_x',
                        'contents' => $koordinat[0]
                    ],
                    [
                        'name' => 'lokasi_koordinat_y',
                        'contents' => $koordinat[1]
                    ]
                ]);
            }
            $response = json_decode($response->getBody()->getContents(), true);

            // session()->put('status', $response['info']);   
            // if ($request->admin_pst_id === null) {
            //     return redirect('admin/master_event_cabang');
            // }
            // if ($request->admin_cab_id === null) {
            //     return redirect('admin/master_event_pusat');
            // }            
            echo "Create Event Success";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            //session()->put('statusT', $response['info']);
            //return redirect('admin/master_event');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	//dd(session('pabi_token_api'));
        try{ 
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'event/jenis/event', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_jenis_event = $response['data'];

            $response = $this->guzzle('GET', 'event/by/jenis-event-id/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_simposium = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_edit', 
            	compact('data_event', 'data_admin_pusat', 'data_provinsi', 'data_jenis_event', 'data_event_simposium'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->file('foto_event') !== null) {
            $tgl = new DateTime();
            $r = $request->file('foto_event');
            $path = $r->getPathname();
            $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
            $mime = $r->getmimeType();   
        }
        $nsei = '';
        if ($request->numpang_simposium_event_id !== 'undefined') {
            $nsei = $request->numpang_simposium_event_id;
        }
        try{
            $koordinat = explode(";", $request->kordinat);
            if ($request->file('foto_event') !== null) {
                $response = $this->guzzleMultipart('POST','event/update/'.$id, [
                    [
                        'name' => 'admin_pusat_id',
                        'contents' => $request->admin_pst_id
                    ],
                    [
                        'name' => 'admin_cabang_id',
                        'contents' => $request->admin_cab_id
                    ],
                    [
                        'name' => 'nama_event',
                        'contents' => $request->nama_event
                    ],
                    [
                        'name' => 'numpang_simposium_event_id',
                        'contents' => $nsei
                    ],
                    [
                        'name' => 'jenis_event_id',
                        'contents' => $request->jenis_event_id
                    ],
                    [
                        'name' => 'nama_bank',
                        'contents' => $request->nama_bank
                    ],
                    [
                        'name' => 'no_rek',
                        'contents' => $request->no_rek
                    ],
                    [
                        'name' => 'pemilik_rek',
                        'contents' => $request->pemilik_rek
                    ],
                    [
                        'name' => 'jenis_event',
                        'contents' => $request->jenis_event
                    ],
                    [
                        'name' => 'tgl_event',
                        'contents' => $request->tgl_event
                    ],
                    [
                        'name' => 'jam_mulai',
                        'contents' => $request->jam_mulai
                    ],
                    [
                        'name' => 'jam_selesai',
                        'contents' => $request->jam_selesai
                    ],
                    [
                        'name' => 'max_event',
                        'contents' => $request->max_event
                    ],
                    [
                        'name' => 'deskripsi',
                        'contents' => $request->deskripsi
                    ],
                    [
                        'name' => 'prov_id',
                        'contents' => $request->prov_id
                    ],
                    [
                        'name' => 'kota_id',
                        'contents' => $request->kota_id
                    ],
                    [
                        'name' => 'kec_id',
                        'contents' => $request->kec_id
                    ],
                    [
                        'name' => 'lokasi_alamat',
                        'contents' => $request->lokasi_alamat
                    ],
                    [
                        'name' => 'lokasi_koordinat_x',
                        'contents' => $koordinat[0]
                    ],
                    [
                        'name' => 'lokasi_koordinat_y',
                        'contents' => $koordinat[1]
                    ],
                    [
                        'Content-type' => 'multipart/form-data',
                        'name' => 'foto_event',
                        'filename' => $org,
                        'Mime-Type'=> $mime,
                        'contents' => fopen($path, 'r' )
                    ]
                ]);
            } else {
                $response = $this->guzzleMultipart('POST','event/update/'.$id, [
                    [
                        'name' => 'admin_pusat_id',
                        'contents' => $request->admin_pst_id
                    ],
                    [
                        'name' => 'admin_cabang_id',
                        'contents' => $request->admin_cab_id
                    ],
                    [
                        'name' => 'nama_event',
                        'contents' => $request->nama_event
                    ],
                    [
                        'name' => 'numpang_simposium_event_id',
                        'contents' => $nsei
                    ],
                    [
                        'name' => 'jenis_event_id',
                        'contents' => $request->jenis_event_id
                    ],
                    [
                        'name' => 'nama_bank',
                        'contents' => $request->nama_bank
                    ],
                    [
                        'name' => 'no_rek',
                        'contents' => $request->no_rek
                    ],
                    [
                        'name' => 'pemilik_rek',
                        'contents' => $request->pemilik_rek
                    ],
                    [
                        'name' => 'jenis_event',
                        'contents' => $request->jenis_event
                    ],
                    [
                        'name' => 'tgl_event',
                        'contents' => $request->tgl_event
                    ],
                    [
                        'name' => 'jam_mulai',
                        'contents' => $request->jam_mulai
                    ],
                    [
                        'name' => 'jam_selesai',
                        'contents' => $request->jam_selesai
                    ],
                    [
                        'name' => 'max_event',
                        'contents' => $request->max_event
                    ],
                    [
                        'name' => 'deskripsi',
                        'contents' => $request->deskripsi
                    ],
                    [
                        'name' => 'prov_id',
                        'contents' => $request->prov_id
                    ],
                    [
                        'name' => 'kota_id',
                        'contents' => $request->kota_id
                    ],
                    [
                        'name' => 'kec_id',
                        'contents' => $request->kec_id
                    ],
                    [
                        'name' => 'lokasi_alamat',
                        'contents' => $request->lokasi_alamat
                    ],
                    [
                        'name' => 'lokasi_koordinat_x',
                        'contents' => $koordinat[0]
                    ],
                    [
                        'name' => 'lokasi_koordinat_y',
                        'contents' => $koordinat[1]
                    ]
                ]);
            }
            $response = json_decode($response->getBody()->getContents(), true);

            // session()->put('status', $response['info']);   
            // if ($request->admin_pst_id === null) {
            //     return redirect('admin/master_event_cabang');
            // }
            // if ($request->admin_cab_id === null) {
            //     return redirect('admin/master_event_pusat');
            // } 
            echo "Update Event Success";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
            // session()->put('statusT', $response['info']);
            // return redirect('admin/master_event');
        }
    }

    public function destroy($id)
    {
        try{
            $response = $this->guzzle('POST', 'event/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            // session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
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

    public function isi_buku_tamu(Request $request)
    {
        //dd(session('pabi_token_api'));
        $id = $request->id;
//        dd($id);
        try{ 
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_isi_buku_tamu', 
                compact('data_buku_tamu'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function update_status_hadir_n_acc(Request $request)
    {
        //dd($request->arr_data);
        try{
            for ($i = 0; $i < count($request->arr_data); $i++) { 
                // if ($request->arr_data[$i][2] == 1) {
                //     if ($request->arr_data[$i][1] != 1 && $request->arr_data[$i][1] != $request->arr_data[$i][2]) {
                //     # code...
                //     }
                // }

                $response = $this->guzzle('POST','buku-tamu/update/'.$request->arr_data[$i][0],[
                    'status_acc' =>  $request->arr_data[$i][1]
                ]);
                $response = json_decode($response->getBody()->getContents(), true);   
            }
            echo "Data Berhasil Di Simpan";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //session()->put('statusT', $response['info']);
            //return redirect('member/event_cabang');
        }
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

    public function index2()
    {
        try{
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            $response = $this->guzzle('GET', 'event/pusat/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'master_event_cabang');
            session()->put('nama_menu_header', 'Event Cabang');
            return view('public_admin.master_event.sa.master_event_cabang',[
                'nama_menu'=>'master_event_cabang'
            ], compact('data_event', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function create2()
    {
        try{
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            $response = $this->guzzle('GET', 'event/jenis/event', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_jenis_event = $response['data'];

            $response = $this->guzzle('GET', 'event/by/jenis-event-id/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_simposium = $response['data'];

            return view('public_admin.master_event.sa.modal_tambah_cabang', compact('data_admin_cabang', 'data_provinsi', 'data_jenis_event', 'data_event_simposium'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response['info']);
        }
    }

    public function edit2($id)
    {
        //dd(session('pabi_token_api'));
        try{ 
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            $response = $this->guzzle('GET', 'event/jenis/event', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_jenis_event = $response['data'];

            $response = $this->guzzle('GET', 'event/by/jenis-event-id/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_simposium = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_edit_cabang', 
                compact('data_event', 'data_admin_cabang', 'data_provinsi', 'data_jenis_event', 'data_event_simposium'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function member()
    {
        try{
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            session()->put('nama_menu_sidebar', 'event_pusat');
            session()->put('nama_menu_header', 'Event Pusat');
            return view('public_admin.master_event.mbr.master_event_pusat', compact('data_admin_pusat'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }

    public function member2()
    {
        $id = session('pabi_member_id');
        try{
            $response = $this->guzzle('POST', 'member/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_saya = $response['data'];
            $cek = "";
            session()->put('event_simposium', 0); 
            foreach ($data_event_saya as $des) {
                if ($des['admin_pusat_id'] !== null && date('Y') == date('Y', strtotime($des['tgl_event']))) {
                    $cek = "ada";
                    session()->put('event_simposium', 1); 
                }
            }
            if ($cek == "") {
                session()->put('statusT', 'Anda Belum Mendaftar Simposium pada Tahun ini'); 
            }

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'event_cabang');
            session()->put('nama_menu_header', 'Event Cabang');
            return view('public_admin.master_event.mbr.master_event_cabang', compact('data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }
    }


    public function dafar_peserta_event(Request $request)
    { 
        $id_event = $request->id_event;
        $id_member = $request->id_member; 
        $status_hadir = 0;
        $psn = "";
        try{
            $response = $this->guzzle('POST','buku-tamu/create',[
                'event_id' =>  $id_event,
                'member_id' => $id_member
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['message'] != 'failed') {
                $response = $this->guzzle('GET','event/'.$id_event,[]);
                $response = json_decode($response->getBody()->getContents(), true);
                $max_event = $response['data']['max_event'];

                $response = $this->guzzle('POST','event/update/'.$id_event,[
                    'max_event' =>  ($max_event-1)
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                echo "success";
            } else {
                echo $response['info'];    
            }            
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //session()->put('statusT', $response['info']);
            //return redirect('member/event_cabang');
        }
    }

    public function div_tabel_event_cabang(Request $request)
    {
        //dd($request);
        try {
            $response = $this->guzzle('POST', 'event/cabang/'.$request->admin_cabang_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.sa.div_tabel_event_cabang', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function div_tabel_event_pusat(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'event/pusat/'.$request->admin_pusat_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.sa.div_tabel_event_pusat', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_onoff_pendaftaran_pusat($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_onoff_pendaftaran_pusat', 
                compact('data_event'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function simpan_modal_onoff_pendaftaran_pusat(Request $request, $id)
    {
        $status_event = '1';
        if(empty($request->status_event)){
            $status_event = '2';
        }
        try{
            $response = $this->guzzleMultipart('POST','event/update/'.$id, [
                [
                    'name' => 'status_event',
                    'contents' => $status_event
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function div_tabel_event_pusat_member(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'event/pusat/'.$request->admin_pusat_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.mbr.div_tabel_event_pusat', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_onoff_pendaftaran_cabang($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_onoff_pendaftaran_cabang', 
                compact('data_event'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function simpan_modal_onoff_pendaftaran_cabang(Request $request, $id)
    {
        $status_event = '1';
        if(empty($request->status_event)){
            $status_event = '2';
        }
        try{
            $response = $this->guzzleMultipart('POST','event/update/'.$id, [
                [
                    'name' => 'status_event',
                    'contents' => $status_event
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function div_tabel_event_cabang_member(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'event/cabang/'.$request->admin_cabang_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.mbr.div_tabel_event_cabang', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function isi_buku_tamu_member(Request $request)
    {
        //dd(session('pabi_token_api')); 
        $id = $request->id; 
        try{ 
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.mbr.modal_isi_buku_tamu', 
                compact('data_buku_tamu'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        } 
    }

    public function event_saya()
    {
        session()->put('nama_menu_sidebar', 'event_saya_belum_bayar');
        session()->put('nama_menu_header', 'Event Menunggu Bayar');
        return view('public_admin.master_event.mbr.master_event_saya');   
    }

    public function div_tabel_event_saya_member(Request $request)
    {
        // BELUM BAYAR
        try {
            $response = $this->guzzle('POST', 'member/event/'.$request->member_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'status_bayar' => 2,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.mbr.div_tabel_event_saya', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function div_tabel_event_saya_member_div_pendek(Request $request)
    {
        // BELUM BAYAR
        try {
            $response = $this->guzzle('POST', 'member/event/'.$request->member_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'status_bayar' => 2,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            return view('public_admin.master_event.mbr.div_tabel_event_saya_div_pendek', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function event_saya2()
    {
        session()->put('nama_menu_sidebar', 'event_saya_sudah_bayar');
        session()->put('nama_menu_header', 'Event Akan Datang');
        return view('public_admin.master_event.mbr.master_event_saya_sudah_bayar');   
    }
    public function event_saya_histori()
    {
        session()->put('nama_menu_sidebar', 'event_saya_histori');
        session()->put('nama_menu_header', 'Histori Partisipasi Event');
        return view('public_admin.master_event.mbr.master_event_saya_histori');   
    }

    public function div_tabel_event_saya_member2(Request $request)
    {
        // SUDAH BAYAR
        try {
            $response = $this->guzzle('POST', 'member/event/'.$request->member_id, [
                'start_date' => $request->tgl_event_awal,
                'end_date' => $request->tgl_event_akhir,
                'status_bayar' => 1,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];
            //dd($data_event);
            return view('public_admin.master_event.mbr.div_tabel_event_saya_sudah_bayar', compact('data_event'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_kehadiran($id)
    {
        //dd(session('pabi_token_api'));
        try{ 
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.sa.modal_kehadiran', 
                compact('data_buku_tamu'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function update_status_hadir(Request $request)
    {
        //dd($request->arr_data);
        try{
            for ($i = 0; $i < count($request->arr_data); $i++) { 
                $response = $this->guzzle('POST','buku-tamu/update/'.$request->arr_data[$i][0],[
                    'status_hadir' => $request->arr_data[$i][1]
                ]);
                $response = json_decode($response->getBody()->getContents(), true);   
            }
            echo "Data Berhasil Di Simpan";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //session()->put('statusT', $response['info']);
            //return redirect('member/event_cabang');
        }
    }

    public function tambah_point()
    { 
        return view('public_admin.master_event.sa.maps.maps_tambah_point');
    }

    public function modal_daftar_event($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'event-harga/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_harga = $response['data'];

            //print_r($data_kota); 
            return view('public_admin.master_event.mbr.modal_daftar_event', 
                compact('data_harga'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function simpan_form_modal_daftar_event(Request $request)
    { 
        $tgl = new DateTime();
        $org = $tgl->format('Y-m-d');
        try{
            $response = $this->guzzle('POST','buku-tamu/create',[
                'event_harga_id' =>  $request->event_harga_id,
                'event_id' => $request->event_id,
                'kode_unik' => $request->kode_unik,
                'nominal_bayar' => $request->nominal_bayar,
                'member_id' => $request->member_id,
                'tgl_member_daftar' => $org
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['message'] != 'failed') {
                // $response = $this->guzzle('GET','event/'.$id_event,[]);
                // $response = json_decode($response->getBody()->getContents(), true);
                // $max_event = $response['data']['max_event'];

                // $response = $this->guzzle('POST','event/update/'.$id_event,[
                //     'max_event' =>  ($max_event-1)
                // ]);
                // $response = json_decode($response->getBody()->getContents(), true);

                // $response = $this->guzzle('GET','event-harga/'.$request->event_harga_id,[]);
                // $response = json_decode($response->getBody()->getContents(), true);
                // $kuota_peserta = $response['data']['kuota_peserta'];

                // $response = $this->guzzle('POST','event-harga/update/'.$request->event_harga_id,[
                //     'kuota_peserta' =>  ($kuota_peserta-1)
                // ]);
                // $response = json_decode($response->getBody()->getContents(), true);

                echo "success";
            } else {
                echo $response['info'];    
            }
            // if ($response['info'] != 'Member telah terdaftar di event ini, coba event lain.') {
            //     echo "sukses";
            // } else {
            //     echo $response['info'];
            // }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //session()->put('statusT', $response['info']);
            //return redirect('member/event_cabang');
        }
    }

    public function halaman_isi_buku_tamu($id)
    {
        try{ 
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];
            return view('public_admin.master_event.sa.halaman_isi_buku_tamu', compact('data_buku_tamu'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function halaman_kehadiran($id)
    {
        $param = $this->hamdi_decrypt($id, 'progstyle2020');
        $param = explode("||hamdiramadhan||", $param);
        // echo sizeof($param);exit();
        if(sizeof($param) > 1){ 
            $id = $param[1];
            try{ 
                $response = $this->guzzle('GET', 'buku-tamu/event/'.$id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_buku_tamu = $response['data'];

                $response = $this->guzzle('GET', 'public/event/'.$id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_event = $response['data']; 

                return view('public_admin.master_event.sa.halaman_kehadiran'
                        , compact('data_buku_tamu', 'data_event'));
            }
            catch(RequestException $e){
                $response = json_decode($e->getResponse()->getBody()->getContents(),true);
                // dd($response); 
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function halaman_detail_event($id)
    { 
        $param_id_enc = $id;
        $param = $this->hamdi_decrypt($id, 'progstyle2020');
        $param = explode("$$|$$", $param);
        $id=$param[0];
        
        try{ 
            $response = $this->guzzle('GET', 'event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data']; 

            // dd($data_event);
            if(!empty($data_event) && $data_event['tgl_event'] == $param[1]){
                return view('public_admin.master_event.sa.halaman_detail_event', compact('data_event', 'param_id_enc'));
            } else {
                return view('public_member.404');
            }
        } 
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            // dd($response); 
            return view('public_member.404');
        }
    }

    public function delete_buku_tamu($id)
    {
        try{
            $response = $this->guzzle('POST', 'buku-tamu/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            // session()->put('status', $response['info']);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }


    public function halaman_invoice($buku_tamu_id){ 
        $param = $this->hamdi_decrypt($buku_tamu_id, 'progstyle2020');
        $param = explode("||hamdiramadhan||", $param);
        // echo sizeof($param);exit();
        if(sizeof($param) > 1){ 
            $buku_tamu_id=$param[1];
            try{ 

                $response = $this->guzzle('GET', 'buku-tamu/'.$buku_tamu_id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_buku_tamu = $response['data'];

                $response = $this->guzzle('GET', 'member/'.$data_buku_tamu['member_id'], []);
                $response = json_decode($response->getBody()->getContents(), true); 
                $data_member = $response['data'];

                // echo $data_buku_tamu['event_id']; exit();
                $response = $this->guzzle('GET', 'event/'.$data_buku_tamu['event_id'], []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_event = $response['data']; 

                $response = $this->guzzle('GET', 'setting/landing-page/1', []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_dashboard = $response['data'];
                $buku_tamu_id = $buku_tamu_id;

                session()->put('nama_menu_sidebar', 'event_saya_belum_bayar');
                session()->put('nama_menu_header', 'Event Menunggu Bayar');
                return view('public_admin.master_event.mbr.invoice_buku_tamu', compact('data_event', 'data_buku_tamu', 'data_dashboard', 'data_member', 'buku_tamu_id'));
            }
            catch(RequestException $e){
                $response = json_decode($e->getResponse()->getBody()->getContents(),true);
                // dd($response); 
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function print_halaman_invoice($buku_tamu_id){ 
        $param = $this->hamdi_decrypt($buku_tamu_id, 'progstyle2020');
        $param = explode("||hamdiramadhan||", $param);
        // echo sizeof($param);exit();
        if(sizeof($param) > 1){ 
            $buku_tamu_id=$param[1];
            try{ 

                $response = $this->guzzle('GET', 'buku-tamu/'.$buku_tamu_id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_buku_tamu = $response['data'];

                $response = $this->guzzle('GET', 'member/'.$data_buku_tamu['member_id'], []);
                $response = json_decode($response->getBody()->getContents(), true); 
                $data_member = $response['data'];

                // echo $data_buku_tamu['event_id']; exit();
                $response = $this->guzzle('GET', 'event/'.$data_buku_tamu['event_id'], []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_event = $response['data']; 

                $response = $this->guzzle('GET', 'setting/landing-page/1', []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_dashboard = $response['data'];
                $buku_tamu_id = $buku_tamu_id;
 
 

                PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                //pass view file
                $pdf = PDF::loadView('public_admin.master_event.mbr.print_invoice_buku_tamu' 
                        , compact('data_event', 'data_buku_tamu', 'data_dashboard', 'data_member', 'buku_tamu_id'));
                $pdf->setPaper('A4', 'Portrait');
                //download pdf
                return $pdf->stream('asd.pdf');

                // return view('public_admin.master_event.mbr.invoice_buku_tamu', compact('data_event', 'data_buku_tamu', 'data_dashboard', 'data_member', 'buku_tamu_id'));
            }
            catch(RequestException $e){
                $response = json_decode($e->getResponse()->getBody()->getContents(),true);
                // dd($response); 
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function sendInvoice($buku_tamu_id) {
        // return $buku_tamu_id;
        try{ 

            $response = $this->guzzle('GET', 'buku-tamu/'.$buku_tamu_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];

            $response = $this->guzzle('GET', 'member/'.$data_buku_tamu['member_id'], []);
            $response = json_decode($response->getBody()->getContents(), true); 
            $data_member = $response['data'];

            // echo $data_buku_tamu['event_id']; exit();
            $response = $this->guzzle('GET', 'event/'.$data_buku_tamu['event_id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data']; 
            $data_buku_tamu_c = Carbon::parse($data_buku_tamu['tgl_member_daftar']);

            $response = $this->guzzle('GET', 'setting/landing-page/1', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_dashboard = $response['data'];

            $dftr_hari = date('d', strtotime($data_buku_tamu['tgl_member_daftar']));
            $dftr_bulan = date('m', strtotime($data_buku_tamu['tgl_member_daftar']));
            $dftr_tahun = date('Y', strtotime($data_buku_tamu['tgl_member_daftar']));

            $invoice_number = $dftr_hari . '/' . $data_buku_tamu['event_id'] . '.' . $dftr_bulan . '.' . $data_buku_tamu['id'] . '/' . $dftr_tahun;

            $expired_bayar = date('Y-m-d', strtotime($data_buku_tamu['expired_bayar']));
            $expired_bayar_c = Carbon::parse($expired_bayar);
            $tgl_event_c = Carbon::parse($data_event['tgl_event']);
            $expired_bayar_jam = date('H:00', strtotime($data_buku_tamu['expired_bayar']));

            $dataMail = [
                'alamat' => $data_dashboard['alamat'],
                'kota_saja' => $data_dashboard['kota'],
                'kota' => $data_dashboard['kota'], $data_dashboard['provinsi'], 'Indonesia',
                'telp' => $data_dashboard['no_telp'],
                'dftr_hari' => $dftr_hari,
                'tgl_buku_tamu' => $data_buku_tamu_c->format('d M Y'),
                'tgl_bayar' => $expired_bayar_c->format('d M Y'),
                'expired_bayar_jam' => $expired_bayar_jam,
                'firstname' => $data_member['firstname'], $data_member['lastname'], $data_member['gelar'],
                'alamat_rumah' => $data_member['alamat_rumah'],
                'kota_rumah' => $data_member['nama_kota_kota'],
                'no_hp' => $data_member['no_telp'], '-', $data_member['no_hp'],
                'email_pengguna' => $data_member['email'],
                'total_due' => number_format($data_buku_tamu['nominal_bayar'] + $data_buku_tamu['kode_unik'],0,",","."),
                'nama_event' => $data_event['nama_event'],
                'tgl_event' => $tgl_event_c->format('d M Y'),
                'alamat_event' => $data_event['lokasi_alamat'],
                'nominal_bayar' => number_format($data_buku_tamu['nominal_bayar'] ,0,",","."),
                'kode_unik' => number_format( $data_buku_tamu['kode_unik'],0,",","."),
                'nominal_bayar_kode_unik' => number_format($data_buku_tamu['nominal_bayar'] + $data_buku_tamu['kode_unik'],0,",",".")
            ];

            // Check Email Jika Empty
            if ($data_member['email'] == '' || $data_member['email'] == null) {
                Alert::error('Send Invoice gagal dikirim, lengkapi data diri anda.', 'Send Invoice Failed');
                return redirect()->back();
            }
            // End Check Email Jika Empty

            // Check Valid Email (Gmail)
            $sender = 'pabimembership@gmail.com';
            $email = $data_member['email'];
            $validator = new \EmailValidator\Validator();
            $resultValid = $validator->isValid($email);

            if ($resultValid == false) {
                Alert::error('Send Invoice gagal dikirim, email anda tidak valid, gunakan email valid gmail.', 'Send Invoice Failed');
                return redirect()->back();
            }
            // End Check Valid Email (Gmail)
        
            Mail::send('public_admin.mail.invoice', $dataMail, function($message) use($data_member, $dftr_hari) {
                $message->to($data_member['email'], $data_member['email'])->subject('Invoice from PABI Membership');
                $message->from('pabimembership@gmail.com', 'Invoice PABI MEMBERSHIP - '.$dftr_hari);
            });
            
            Alert::success('Send Invoice telah terkirim, check email.', 'Send Invoice Success');
            session()->put('status', 'Send Invoice telah terkirim, check email.');
            return redirect()->back();
            // Send Invoice
        }
        catch(RequestException $e){
            // $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            // dd($response); 
            Alert::error('Gagal mengirim invoice, silahkan cek email Anda', 'Gagal');
            session()->put('statusT', 'Gagal mengirim invoice, silahkan cek email Anda');
        }
    }

    public function upload_bukti_bayar_event(Request $request)
    {
        $buku_tamu_id = $request->buku_tamu_id;
        try{ 
            $response = $this->guzzle('GET', 'buku-tamu/'.$buku_tamu_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];

            $response = $this->guzzle('GET', 'member/'.$data_buku_tamu['member_id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_event.mbr.upload_bukti_bayar_event'
                , compact('data_buku_tamu', 'data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function simpan_upload_bukti_bayar_event(Request $request)
    {
        $tgl = new DateTime();
        $r = $request->file('bukti_bayar');
        $path = $r->getPathname();
        $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
        $mime = $r->getmimeType();   
        try{
            $response = $this->guzzleMultipart('POST','buku-tamu/update/'.$request->buku_tamu_id, [
                [
                    'name' => 'nama_bank',
                    'contents' => $request->nama_bank
                ],
                [
                    'name' => 'tgl_bayar',
                    'contents' => $request->tgl_bayar
                ],
                [
                    'name' => 'nomor_rekening',
                    'contents' => $request->nomor_rekening
                ],
                [
                    'name' => 'nama_pemilik_rekening',
                    'contents' => $request->nama_pemilik_rekening
                ],
                [
                    'name' => 'nominal_terbayar',
                    'contents' => $request->nominal_terbayar
                ],
                [
                    'name' => 'status_bayar',
                    'contents' => '1'
                ],
                // [
                //     'name' => 'status_acc',
                //     'contents' => '1'
                // ],
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'bukti_bayar',
                    'filename' => $org,
                    'Mime-Type'=> $mime,
                    'contents' => fopen($path, 'r' )
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            echo "Bukti Pembayaran Sudah Terkirim";
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            //echo "Pengajuan Bukti Pembayaran Gagal";
            echo "Bukti Pembayaran Sudah Terkirim";
            //dd($response); 
        }
    }

    public function halaman_detail_event_public($id)
    {  
        // echo $id . '<br>';
        $param_id_enc = $id;
        $param = $this->hamdi_decrypt($id, 'progstyle2020');
        $param = explode("$$|$$", $param);
        $id=$param[0];

        try{ 
            $response = $this->guzzle('GET', 'public/event/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data']; 

            // dd($data_event);
            if(!empty($data_event) && $data_event['tgl_event'] == $param[1]){
                return view('public_member.detail_event', compact('data_event', 'param_id_enc'));
            } else {
                return view('public_member.404');
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }
    public function event_maps_public($koor)
    {    
        // echo $koor;
        $koordinat=$koor;

        return view('public_member.maps_event', compact('koordinat'));
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

    public function pembayaran_pusat_page()
    {
        try{ 

            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'event', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'pembayaran_pusat_page  ');
            session()->put('nama_menu_header', 'Pembayaran Event Pusat');
            return view('public_admin.master_event.sa.pembayaran_pusat_page', compact('data_event', 'data_admin_pusat'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    } 

    public function div_tabel_pembayaran_pusat(Request $request)
    {
        //dd($request);
        $event_id=$request->event_id;
        try {
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$event_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];
            //dd($data_buku_tamu);

            return view('public_admin.master_event.sa.div_tabel_pembayaran_pusat', compact('data_buku_tamu'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function div_event_admin_pusat(Request $request)
    { 
        $id_pusat = $request->id;
        try {
            $response = $this->guzzle('POST', 'event/pusat/'.$id_pusat, [ 
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_admin_pusat = $response['data'];

            echo '<option value="">-- Pilih Event --</option>';
                foreach ($data_event_admin_pusat as $dv) {
                    $sel = '';
                    if ($id_pusat == $dv['id']) {
                        $sel = 'selected=""';
                    }
                    echo '<option value="'.$dv['id'].'" '.$sel.'>'.$dv['nama_event'].'</option>';
                }
            } 
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    } 

    public function set_status_bayar(Request $request,$id)
    {
        // YANG DI UPDATE GAJADI STATUS_BAYAR, JADINYA STATUS_ACC.
        // status_bayar = 1 itu artinya sudah bayar, saat klik verifikasi pembayaran di member jadi 1
        // status_acc = acc admin
        $status_bayar = $request->status_bayar; 
        try{ 
                $response = $this->guzzleMultipart('POST','buku-tamu/update/'.$id, [
                    [
                        'name' => 'status_acc',
                        'contents' => $status_bayar
                    ]
                ]);
            
            $response = json_decode($response->getBody()->getContents(), true);

            // session()->put('status', $response['info']);   
            // if ($request->admin_pst_id === null) {
            //     return redirect('admin/master_event_cabang');
            // }
            // if ($request->admin_cab_id === null) {
            //     return redirect('admin/master_event_pusat');
            // }  
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
            // session()->put('statusT', $response['info']);
            // return redirect('admin/master_event');
        }
    } 
    public function pembayaran_cabang_page()
    {
        try{ 
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            // jika cabang
            if(request()->session()->get('pabi_role_id') == 3){
                $response = $this->guzzle('POST', 'event/cabang/'.session('admin_cabang_id'), []);
            } else {
                $response = $this->guzzle('GET', 'event', []);
            }
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'pembayaran_cabang_page');
            session()->put('nama_menu_header', 'Pembayaran Event Cabang');
            return view('public_admin.master_event.sa.pembayaran_cabang_page', compact('data_event', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }
    public function div_tabel_pembayaran_cabang(Request $request)
    {
        //dd($request);
        $event_id=$request->event_id;
        try {
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$event_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];
            //dd($data_buku_tamu);

            return view('public_admin.master_event.sa.div_tabel_pembayaran_cabang', compact('data_buku_tamu'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function div_event_admin_cabang(Request $request)
    { 
        $id_cabang = $request->id;
        try {
            $response = $this->guzzle('POST', 'event/cabang/'.$id_cabang, [ 
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event_admin_cabang = $response['data'];

            echo '<option value="">-- Pilih Event --</option>';
                foreach ($data_event_admin_cabang as $dv) {
                    $sel = '';
                    if ($id_cabang == $dv['id']) {
                        $sel = 'selected=""';
                    }
                    echo '<option value="'.$dv['id'].'" '.$sel.'>'.$dv['nama_event'].'</option>';
                }
            } 
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    } 

    public function cek_ikut_serta_event_induk(Request $request)
    {
        $numpang_simposium_event_id = $request->numpang_simposium_event_id;
        $member_id = $request->member_id;
        try{ 
            $response = $this->guzzle('POST', 'buku-tamu/cek/ikut-serta/event-induk', [
                'event_id' => $numpang_simposium_event_id, 
                'member_id' => $member_id
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_cek = $response['data'];
            
            $msg = 'tidak';
            if (count($data_cek) > 0) {
                $msg = 'ada';
            } 
            echo $msg;
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function expired_pembayaran_pusat_page()
    {
        try{ 
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            // jika pusat
            if(request()->session()->get('pabi_role_id') == 2){
                $response = $this->guzzle('POST', 'event/pusat/'.session('admin_pusat_id'), []);
            } else {
                $response = $this->guzzle('GET', 'event', []);
            }
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'expired_pembayaran_pusat_page');
            session()->put('nama_menu_header', 'Expired Pembayaran Event Pusat');
            return view('public_admin.master_event.sa.expired_pembayaran_pusat_page', compact('data_event', 'data_admin_pusat'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function expired_pembayaran_cabang_page()
    {
        try{ 
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            // jika cabang
            if(request()->session()->get('pabi_role_id') == 3){
                $response = $this->guzzle('POST', 'event/cabang/'.session('admin_cabang_id'), []);
            } else {
                $response = $this->guzzle('GET', 'event', []);
            }
            $response = json_decode($response->getBody()->getContents(), true);
            $data_event = $response['data'];

            session()->put('nama_menu_sidebar', 'expired_pembayaran_cabang_page');
            session()->put('nama_menu_header', 'Expired Pembayaran Event Cabang');
            return view('public_admin.master_event.sa.expired_pembayaran_cabang_page', compact('data_event', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    }

    public function div_tabel_expired_pembayaran_pusat(Request $request)
    {
        //dd($request);
        $event_id=$request->event_id;
        try {
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$event_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];
            //dd($data_buku_tamu);

            return view('public_admin.master_event.sa.div_tabel_expired_pembayaran_pusat', compact('data_buku_tamu'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }
    
    public function div_tabel_expired_pembayaran_cabang(Request $request)
    {
        //dd($request);
        $event_id=$request->event_id;
        try {
            $response = $this->guzzle('GET', 'buku-tamu/event/'.$event_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_buku_tamu = $response['data'];
            //dd($data_buku_tamu);

            return view('public_admin.master_event.sa.div_tabel_expired_pembayaran_cabang', compact('data_buku_tamu'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function set_status_bayar_menunggu_bayar(Request $request, $id)
    {
        $status_bayar = $request->status_bayar; 
        try{ 
            if ($status_bayar == 0) {
                $response = $this->guzzleMultipart('GET','buku-tamu/update/status-bayar-nol/'.$id, []);   
                $response = json_decode($response->getBody()->getContents(), true);
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response); 
        }
    } 
}
