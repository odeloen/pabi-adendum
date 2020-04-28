<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Support\Guzzle\GuzzleConfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Exception\RequestException;
use DateTime;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data_member = null;
            switch (session('pabi_role_id')) {
                case 1:
                $response = $this->guzzle('GET', 'member', []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                case 2:
                $response = $this->guzzle('POST', 'member/verif/pusat', [
                    'cabang_verif' => '2,3',
                    'pusat_verif' => '1',
                    'admin_pusat_id' => session('admin_pusat_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                case 3:
                $response = $this->guzzle('POST', 'member/verif/cabang', [
                    'cabang_verif' => '1',
                    'admin_cabang_id' => session('admin_cabang_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                default:
                break;
            }
            //dd(session('admin_pusat_id'));
            return view('public_admin.master_member.sa.master_member', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
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
        return view('public_admin.master_member.sa.modal_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $response = $this->guzzle('POST','register',[
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            session()->put('status', $response['info']);   
            return redirect('admin/master_member');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_member');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $response = $this->guzzle('GET', 'member-all/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']['member'];
            $data_pendidikan = $response['data']['pendidikan'];
            $data_pasangan = $response['data']['pasangan'];
            $data_anak = $response['data']['anak'];
            $data_jurnal = $response['data']['jurnal'];
            $data_ujian = $response['data']['ujian'];
            $data_minat_bidang = $response['data']['minat_bidang'];
            $data_file = $response['data']['file'];

            $response = $this->guzzle('GET', 'user/detail/'.$data_member['user_id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_user = $response['data'];

            $response = $this->guzzle('GET', 'wilayah/kabupaten', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_kota = $response['data'];
            
            $response = $this->guzzle('GET', 'wilayah/provinsi', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_provinsi = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];
            $id_prov_member = 0;
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
            return view('public_admin.master_member.sa.modal_edit', 
                compact('data_member', 
                    'data_kota', 
                    'data_provinsi', 
                    'id_prov_member', 
                    'data_pasangan', 
                    'data_anak', 
                    'data_pendidikan', 
                    'data_minat_bidang', 
                    'data_ujian', 
                    'kab_by_prov',
                    'data_admin_cabang',
                    'data_user'
                )
            );
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            return redirect()->back()->withErrors($response['info']);
        }
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
        try{
            $response = $this->guzzle('POST', 'member/delete/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            session()->put('status', $response['info']);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            session()->put('statusT', $response['info']);
        }
    }

    public function simpan_verif_cabang(Request $request, $id)
    {
        $tgl = new DateTime();
        $cabang_tgl = $tgl->format('Y-m-d');
        $cabang_verif = 2;
        if(empty($request->cabang_verif)){
            $cabang_verif = 3;
        }
        try{
            $response = $this->guzzle('POST','cabang/verif/update/'.$id,[
                'cabang_verif' => $cabang_verif,
                'cabang_ket' => $request->cabang_ket,
                'cabang_tgl' => $cabang_tgl 
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            session()->put('status', $response['info']);   
            return redirect('admin/master_member_belum_verif_cabang');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            // dd($response);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_member_belum_verif_cabang');
        }
    }

    public function simpan_verif_pusat(Request $request, $id)
    {
        $tgl = new DateTime();
        $pusat_tgl = $tgl->format('Y-m-d');
        $pusat_verif = 2;
        if(empty($request->pusat_verif)){
            $pusat_verif = 3;
        }
        try{
            $response = $this->guzzle('POST','pusat/verif/update/'.$id,[
                'pusat_verif' => $pusat_verif,
                'pusat_ket' => $request->pusat_ket,
                'pusat_tgl' => $pusat_tgl
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            session()->put('status', $response['info']);   

            if ($pusat_verif == 2) {
                // $response = $this->guzzle('POST','borang/kredit-poin/periode',[
                //     'member_id' => $id
                // ]);
                // $response = json_decode($response->getBody()->getContents(), true);
                // $data_borang = $response['data'];

                // $tahun_periode_awal = $tgl->format('Y');
                // $tahun_periode_akhir = date('Y', strtotime('+4 year', strtotime($tgl->format('Y-m-d'))));
                // if (empty($data_borang)) {
                //     $response = $this->guzzle('POST','borang/create',[
                //         'member_id' => $id, 
                //         'tahun_periode_awal' => $tahun_periode_awal, 
                //         'tahun_periode_akhir' => $tahun_periode_akhir
                //     ]);
                //     $response = json_decode($response->getBody()->getContents(), true);
                //     $message = $response['info'];
                // }
            }

            return redirect('admin/master_member_belum_verif_pusat');
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            session()->put('statusT', $response['info']);
            return redirect('admin/master_member_belum_verif_pusat');
        }
    } 

    public function index2()
    {
        try{
            $data_member = null;
            switch (session('pabi_role_id')) {
                case 1:
                $response = $this->guzzle('GET', 'member', []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                case 2:
                $response = $this->guzzle('POST', 'member/verif/pusat', [
                    'cabang_verif' => '2,3',
                    'pusat_verif' => '2,3',
                    'admin_pusat_id' => session('admin_pusat_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                case 3:
                $response = $this->guzzle('POST', 'member/verif/cabang', [
                    'cabang_verif' => '2,3',
                    'admin_cabang_id' => session('admin_cabang_id')
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];
                break;
                default:
                break;
            }
            //dd(session('admin_pusat_id'));
            return view('public_admin.master_member.sa.master_member', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            $message = $response['info'];
            return redirect()->back()->withErrors($message);
        }

    }

    public function histori_pengajuan($id)
    {
        try{
            $response = $this->guzzle('GET', 'pengajuan/history/member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pengajuan = $response['data'];

            return view('public_admin.master_member.sa.modal_histori_pengajuan', compact('data_pengajuan'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            return redirect()->back()->withErrors($response['info']);
        }
    }

    public function index_cabang_1()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_belum_verif_cabang');
            session()->put('nama_menu_header', 'Keanggotaan Belum Diverifikasi Cabang');
            return view('public_admin.master_member.admin_cabang.master_member_belum_verif',[
                'nama_menu'=>'master_member_belum_verif_cabang'
            ] ,compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_belum_verif_cabang(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/cabang', [
                'cabang_verif' => '1',
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_cabang.div_tabel_member_belum_verif_cabang', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function index_cabang_2()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_sudah_verif_cabang');
            session()->put('nama_menu_header', 'Keanggotaan Sudah Diverifikasi Cabang');
            return view('public_admin.master_member.admin_cabang.master_member_sudah_verif',[
                'nama_menu'=>'master_member_sudah_verif_cabang'
            ],compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_sudah_verif_cabang(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/cabang', [
                'cabang_verif' => '2,3',
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_cabang.div_tabel_member_sudah_verif_cabang', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function index_pusat_1()
    {
        try {
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_belum_verif_pusat');
            session()->put('nama_menu_header', 'Keanggotaan Belum Diverifikasi Pusat');
            return view('public_admin.master_member.admin_pusat.master_member_belum_verif',
                [
                    'nama_menu'=>'master_member_belum_verif_pusat'
                ],
             compact('data_admin_pusat', 'data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_belum_verif_pusat(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/pusat', [
                'cabang_verif' => '2,3',
                'pusat_verif' => '1',
                'admin_pusat_id' => $request->admin_pusat_id,
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_pusat.div_tabel_member_belum_verif_pusat', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function index_pusat_2()
    {
        try {
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_sudah_verif_pusat');
            session()->put('nama_menu_header', 'Keanggotaan Sudah Diverifikasi Pusat');
            return view('public_admin.master_member.admin_pusat.master_member_sudah_verif',
                [
                    'nama_menu'=>'master_member_sudah_verif_pusat'
                ], 
                compact('data_admin_pusat', 'data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_sudah_verif_pusat(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/pusat', [
                'cabang_verif' => '2,3',
                'pusat_verif' => '2,3',
                'admin_pusat_id' => $request->admin_pusat_id,
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '1'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_pusat.div_tabel_member_sudah_verif_pusat', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function update_modal_verif_pusat($id)
    {
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];
            
            return view('public_admin.master_member.admin_pusat.modal_verif', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function update_modal_verif_cabang($id)
    {
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];
            
            return view('public_admin.master_member.admin_cabang.modal_verif', compact('data_member'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function modal_reset_password($member_id)
    {
        try{
            $response = $this->guzzle('GET', 'member/'.$member_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $user_id = $response['data']['user_id'];
            
            return view('public_admin.master_member.sa.modal_reset_password', compact('user_id'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function simpan_form_update_reset_password_admin(Request $request, $id)
    {
        try{
            $response = $this->guzzle('POST', 'user/password/reset/da5dd030f42f510eee96b6b9245462ad/user/'.$id, [
                'new_password' => $request->new_password,
                'new_password_confirmation' => $request->new_password_confirmation
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            echo $response['info'];
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function modalactive(Request $request, $id)
    {
        try{ 
            $url_back = $request->url_back;
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_active_m = $response['data']; 
            // dd($response);

            $response = $this->guzzle('GET', 'user/detail/'.$data_active_m['user_id'], []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_active = $response['data'];

            return view('public_admin.master_member.sa.modal_active',[
            ],  compact('data_active', 'data_active_m', 'url_back'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            echo $response['info'];
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function simpan_member_active(Request $request, $id)
    { 
        $status_active = 1;
        if(empty($request->status_active)){
            $status_active = 2;
        }
        try{
            $response = $this->guzzle('POST','user/update/'.$id,[
                'status_active' => $status_active,
                'ket_active' => $request->ket_active
            ]);
            $response = json_decode($response->getBody()->getContents(), true);

            $response = $this->guzzle('POST','member/update/'.$request->member_id,[
                'user_id' => $id,
                'is_non_aktif' => $status_active,
                'alasan_non_aktif' => $request->ket_active
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $msg = '';
            if ($response['message'] == 'success') {
                $msg = 'Member Sudah Di Nonaktifkan';
                if ($status_active == 1) {
                    $msg = 'Member Sudah Aktif';
                }
            }

            session()->put('status', $msg);   
            return redirect($request->url_back);
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
            session()->put('statusT', $response['info']);
            return redirect($request->url_back);
        }
    }

    public function modal_pengajuan_pindah_cabang(Request $request)
    { 
        $id = $request->id_member;
        $id_member = $request->id_member;
        try{
            $response = $this->guzzle('GET', 'member/'.$id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];
            
            return view('public_admin.keanggotaan.modal_pengajuan_pindah_cabang', compact('data_member', 'id_member', 'data_admin_cabang'));
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            //return redirect()->back()->withErrors($response['info']);
        }
    }

    public function simpan_pengajuan_pindah_cabang(Request $request)
    {
        $id = $request->id_member;
        $id_member = $request->id_member;
        try{
            $kode_unik=$id.'_'.date('Y-m-d_H-i-s');

            $response = $this->guzzle('POST','pengajuan/member/create',[
                'member_id' => $id
                , 'tanggal_masuk' => date('Y-m-d')
                , 'dari_cabang' => $request->pindah_cb_dari
                , 'ke_cabang' => $request->pindah_cb_ke
                , 'kode_unik' => $kode_unik
            ]);
            $response = json_decode($response->getBody()->getContents(), true); 
            if($response['message'] == 'success'){   
                $tgl = new DateTime();
                $r = $request->file('pindah_cb_file_name');
                $path = $r->getPathname();
                $org = $tgl->format('YmdHis') . "_" . $r->getClientOriginalName();
                $mime = $r->getmimeType();

                $response = $this->guzzleMultipart('POST','file/create', [
                    [
                        'name' => 'member_id',
                        'contents' => $id
                    ], 
                    [
                        'name' => 'keterangan',
                        'contents' => $request->keterangan
                    ],
                    [
                        'name' => 'jenis_file',
                        'contents' => 'Berkas Perpindahan Cabang'
                    ],
                    [
                        'name' => 'kode_unik',
                        'contents' => $kode_unik
                    ],
                    [
                        'Content-type' => 'multipart/form-data',
                        'name' => 'file_name',
                        'filename' => $org,
                        'Mime-Type'=> $mime,
                        'contents' => fopen($path, 'r')
                    ],
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                if($response['message'] == 'success'){ 
                    echo $response['message'];
                } else {
                    echo $response['info'];
                }
            } else {
                echo $response['info'];
            }
        }
        catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            //return redirect()->back()->withErrors($response['info']);
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

    public function pengajuan_pindah_cabang_belum_verif1()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'pengajuan_pindah_cabang_belum_verif1');
            session()->put('nama_menu_header', 'Pengajuan Perpindahan Cabang Belum Verifikasi');
            return view('public_admin.pengajuan_pindah_cabang.pengajuan_pindah_cabang_belum_verif', compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_pengajuan_pindah_cabang_belum_verif1(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'pengajuan-pindah-cabang/filter/admin', [
                'dari_cabang_id' => $request->admin_cabang_id,
                'cabang_lama_verif' => 1,
                'nama_member' => $request->name_member,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];
            // dd($data_pindah_cabang);
            return view('public_admin.pengajuan_pindah_cabang.div_tabel_pengajuan_pindah_cabang_belum_verif', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function pengajuan_pindah_cabang_sudah_verif1()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'pengajuan_pindah_cabang_sudah_verif1');
            session()->put('nama_menu_header', 'Pengajuan Perpindahan Cabang Sudah Verifikasi');
            return view('public_admin.pengajuan_pindah_cabang.pengajuan_pindah_cabang_sudah_verif', compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_pengajuan_pindah_cabang_sudah_verif1(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'pengajuan-pindah-cabang/filter/admin', [
                'dari_cabang_id' => $request->admin_cabang_id,
                'cabang_lama_verif' => 2,
                'nama_member' => $request->name_member,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];

            return view('public_admin.pengajuan_pindah_cabang.div_tabel_pengajuan_pindah_cabang_belum_verif', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function pengajuan_pindah_cabang_belum_verif2()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'pengajuan_pindah_cabang_belum_verif2');
            session()->put('nama_menu_header', 'Pengajuan Perpindahan Cabang Belum Verifikasi');
            return view('public_admin.pengajuan_pindah_cabang.pengajuan_pindah_cabang_belum_verif2', compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_pengajuan_pindah_cabang_belum_verif2(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'pengajuan-pindah-cabang/filter/admin', [
                'ke_cabang_id' => $request->admin_cabang_id,
                'cabang_baru_verif' => 1,
                'cabang_lama_verif' => 3,
                'nama_member' => $request->name_member,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];

            return view('public_admin.pengajuan_pindah_cabang.div_tabel_pengajuan_pindah_cabang_belum_verif2', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function pengajuan_pindah_cabang_sudah_verif2()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'pengajuan_pindah_cabang_sudah_verif2');
            session()->put('nama_menu_header', 'Pengajuan Perpindahan Cabang Sudah Verifikasi');
            return view('public_admin.pengajuan_pindah_cabang.pengajuan_pindah_cabang_sudah_verif2', compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_pengajuan_pindah_cabang_sudah_verif2(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'pengajuan-pindah-cabang/filter/admin', [
                'ke_cabang_id' => $request->admin_cabang_id,
                'cabang_baru_verif' => 2,
                'nama_member' => $request->name_member,
                'limit' => $request->limit
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];

            return view('public_admin.pengajuan_pindah_cabang.div_tabel_pengajuan_pindah_cabang_sudah_verif2', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_detail_verif_pindah_cabang(Request $request)
    {
        try { 
            $member_id = $request->id;
            $response = $this->guzzle('POST', 'pengajuan/member/bymember/'.$member_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
                // dd($response['data']);
            $data_pindah_cabang = $response['data'];

            return view('public_admin.pengajuan_pindah_cabang.div_detail_pindahcabang', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_verif_pindah_cabang1(Request $request)
    {
        try {
            $response = $this->guzzle('GET', 'pengajuan/member/'.$request->id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];
            return view('public_admin.pengajuan_pindah_cabang.modal_verif_cabang1', compact('data_pindah_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function modal_verif_pindah_cabang2(Request $request)
    {
        try {
            $response = $this->guzzle('GET', 'pengajuan/member/'.$request->id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_pindah_cabang = $response['data'];

            $response = $this->guzzle('GET', 'member/'.$request->member_id, []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            return view('public_admin.pengajuan_pindah_cabang.modal_verif_cabang2', compact('data_pindah_cabang', 'data_member', 'data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function simpan_verifikasi_pengajuan_pindah_cabang_lama(Request $request, $id)
    {
        $tgl = new DateTime();
        $cabang_lama_tgl = $tgl->format('Y-m-d');
        $cabang_lama_verif = 1;
        $cabang_baru_verif = 0;
        if(empty($request->cabang_lama_verif)){
            $cabang_lama_verif = 2;
            $cabang_baru_verif = 2;
        }
        try {
            $response = $this->guzzle('POST','pengajuan/member/update/'.$id,[
                'cabang_lama_verif' => $cabang_lama_verif,
                'cabang_lama_tgl' => $cabang_lama_tgl,
                'cabang_lama_ket' => $request->cabang_lama_ket,
                'cabang_baru_verif' => $cabang_baru_verif
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $pesan = $response['message'];

            if ($pesan == 'success') {
                session()->put('status', 'Verifikasi Perpindahan Cabang Lama Berhasil Tersimpan');   
            } else {
                session()->put('statusT', 'Verifikasi Perpindahan Cabang Lama Gagal Tersimpan');
            }   
            return redirect('admin/pengajuan_pindah_cabang_belum_verif1');
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function simpan_verifikasi_pengajuan_pindah_cabang_baru(Request $request, $id)
    {
        $tgl = new DateTime();
        $cabang_baru_tgl = $tgl->format('Y-m-d');
        $cabang_baru_verif = 1;
        if(empty($request->cabang_baru_verif)){
            $cabang_baru_verif = 2;
        }

        try{
            if($cabang_baru_verif == 1){
                $response = $this->guzzle('GET', 'member/'.$request->member_id, []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];

                $response = $this->guzzle('POST','member/update/'.$request->member_id,[
                    'user_id' => $data_member['user_id'],
                    'card_no' => $request->card_no,
                    'admin_cabang_id' => $request->admin_cabang_id
                ]);
                $response = json_decode($response->getBody()->getContents(), true);
                $pesan = $response['message'];
            }

            $response = $this->guzzle('POST','pengajuan/member/update/'.$id,[
                'cabang_baru_verif' => $cabang_baru_verif,
                'cabang_baru_tgl' => $cabang_baru_tgl,
                'cabang_baru_ket' => $request->cabang_baru_ket
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $pesan = $response['message'];

            if ($pesan == 'success') {
                session()->put('status', 'Verifikasi Perpindahan Cabang Baru Berhasil Tersimpan');   
            } else {
                session()->put('statusT', 'Verifikasi Perpindahan Cabang Baru Gagal Tersimpan');
            }   
            return redirect('admin/pengajuan_pindah_cabang_belum_verif2');
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function master_data_user()
    {
        try {
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_data_user');
            session()->put('nama_menu_header', 'Master Pengguna');
            return view('public_admin.master_member.admin_pusat.master_member_sudah_verif',
                [
                    'nama_menu'=>'master_data_user'
                ], 
                compact('data_admin_pusat', 'data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function index_pusat_inactive()
    {
        try {
            $response = $this->guzzle('GET', 'admin/pusat', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_pusat = $response['data'];

            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_inactive_pusat');
            session()->put('nama_menu_header', 'Anggota yang Sudah Tidak Aktif');
            return view('public_admin.master_member.admin_pusat.master_member_inactive',
                [
                    'nama_menu'=>'master_member_inactive_pusat'
                ], 
                compact('data_admin_pusat', 'data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_inactive_pusat(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/pusat', [
                'cabang_verif' => '2,3',
                'pusat_verif' => '2,3',
                'admin_pusat_id' => $request->admin_pusat_id,
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '2'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_pusat.div_tabel_member_inactive_pusat', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }

    public function index_cabang_inactive()
    {
        try {
            $response = $this->guzzle('GET', 'admin/cabang', []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_admin_cabang = $response['data'];

            session()->put('nama_menu_sidebar', 'master_member_inactive_cabang');
            session()->put('nama_menu_header', 'Anggota yang Sudah Tidak Aktif');
            return view('public_admin.master_member.admin_cabang.master_member_inactive',[
                'nama_menu'=>'master_member_inactive_cabang'
            ],compact('data_admin_cabang'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }

    }

    public function div_tabel_member_inactive_cabang(Request $request)
    {
        try {
            $response = $this->guzzle('POST', 'member/verif/cabang', [
                'cabang_verif' => '2,3',
                'admin_cabang_id' => $request->admin_cabang_id,
                'name_member' => $request->name_member,
                'limit' => $request->limit,
                'is_non_aktif' => '2'
            ]);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            return view('public_admin.master_member.admin_cabang.div_tabel_member_inactive_cabang', compact('data_member'));
        }
        catch(RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);
            dd($response);
        }
    }
}
