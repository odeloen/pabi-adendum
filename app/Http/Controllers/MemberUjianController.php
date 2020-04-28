<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use File;

class MemberUjianController extends Controller
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

    public function simpan_ubah_my_profile_data_ujian(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('POST','ujian/create',[
                'member_id' => $id,
                'nama_ujian' => $request->nama_ujian,
                'tgl_lulus' => $request->tgl_lulus,
                'valid_until' => $request->valid_until,
                'jenis' => $request->jenis
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }

    public function tabel_detail_ujian_hapus($id)
    {   
        try{
            $response = $this->guzzle('POST', 'ujian/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
            //return redirect('admin/myprofile')->withErrors($response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //return redirect()->back()->withErrors($message);
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

    public function simpan_perubahan_data_ujian(Request $request, $id)
    {   
        try{
            $response = $this->guzzle('POST','ujian/update/'.$id,[
                'nama_ujian' => $request->nama_ujian,
                'tgl_lulus' => $request->tgl_lulus,
                'valid_until' => $request->valid_until,
                'jenis' => $request->jenis
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
        }
    }
    
}
