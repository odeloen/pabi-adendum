<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrafikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function div_grafik_jumlah_kredit_poin(){
        
        return view('public_admin.grafik.div_grafik_jumlah_kredit_poin'); 
    }
    public function div_grafik_borang(){
        
        return view('public_admin.grafik.div_grafik_borang'); 
    }
    public function div_grafik_borang_pie_cabang(){
        
        return view('public_admin.grafik.div_grafik_borang_pie_cabang'); 
    }
    public function div_grafik_barang_masuk(){
        
        return view('public_admin.grafik.div_grafik_barang_masuk'); 
    } 
    public function div_grafik_ranah(){
        
        return view('public_admin.grafik.div_grafik_ranah'); 
    }
    public function div_grafik_ranah_bar_cabang(){ 
        $response = $this->guzzle('GET', 'dashboard_grafik_admin_cabang/'.session('admin_cabang_id'), []);
        $response = json_decode($response->getBody()->getContents(), true);
        $data_grafik_cabang = $response['data'];
        // dd($data_grafik_cabang);
        // foreach ($data_grafik_cabang['grafik_borang_per_ranah'] as $r ) {
        //     # code...
        // }
        return view('public_admin.grafik.div_grafik_ranah_bar_cabang'
                , compact('data_grafik_cabang')); 
    }
    public function div_grafik_uang_keluar(){
        return view('public_admin.grafik.div_grafik_uang_keluar'); 
        
    }
    public function div_grafik_borang_bulan()
    { 
        return view('public_admin.grafik.div_grafik_borang_bulan' ); 
        
    }
    public function div_grafik_borang_bulan_bar()
    { 
        
        $date_back = date('Y-m-d', strtotime('-6 months', strtotime(date("Y-m-d"))));
        $date_in = date("Y-m-d");

        $date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));

        $url = 'borang/kredit-poin/bulan';
        $data_bulan_tahun = null;
        $data_member = null;
        try {
            $response = $this->guzzle('POST', $url, [
                'member_id' => session('pabi_member_id'),
                'start_date' => $date_back,
                'end_date' => $date_in,
                'limit' => 100
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];
            $data_bulan_tahun = $response['bulan_tahun']; 
            
            // dd($data_bulan_tahun);

            $dir = 'div_tabel_kredit_poin';
            if (session('pabi_role_id') == 4) {
                $dir = 'div_tabel_kredit_poin_member';
            } 
   
            return view('public_admin.grafik.div_grafik_borang_bulan_bar'
                    , compact('data_member', 'data_bulan_tahun'));
        }
        catch(RequestException $e) {
            return view('public_admin.grafik.div_grafik_borang_bulan_bar'
                    , compact('data_member', 'data_bulan_tahun'));
        }
        
    }
    public function div_laporan_barang_masuk(){
        
        // return view('laporan.laporan_barang.div_laporan_barang_masuk', compact('data_barang_masuk', 'tahun_bulan'));
        // echo 'asdfsdafasdf';
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
}
