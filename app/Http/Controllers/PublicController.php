<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use App\Member;
use App\Model\SettingLandingPage;
use App\Model\MasterBanner;
use App\Model\MasterTentangPabi;
use Alert;
use Input;


use App\Ods\Announcement\Domain\Application\GetNewestAnnouncementListUsecase;
use App\Ods\Announcement\Infrastructure\Persistence\Eloquent\Repositories\AnnouncementEloquentRepository;
use App\ods\announcement\presenter\models\AnnouncementViewModel;

class PublicController extends Controller
{
    private $announcementRepository;

    public function __construct()
    {
        $this->announcementRepository = new AnnouncementEloquentRepository();
    }

    public function public_admin()
    {
        $role_id = session('pabi_role_id');
        session()->put('nama_menu_sidebar', 'dashboard');
        session()->put('nama_menu_header', 'Dashboard');
        // dd(session('admin_pusat_id'));
        // dd(session('admin_cabang_id'));

        $response = $this->guzzle('GET', 'activity', []);
        $response = json_decode($response->getBody()->getContents(), true);
        $data_activity = $response;
        // dd($data_activity);

        if($role_id == 2 || $role_id == 1){ // admin PUSAT  / SUPER ADMIN
            $ob = new PublicController();
            $ob->get_dashboard_admin();

            return view('public_admin.menu_dashboard.dashboard_admin_pusat', compact(['data_activity']));
        } else if($role_id == 3){ // admin CABANG
            $ob = new PublicController();
            $ob->get_dashboard_admin();
            
            return view('public_admin.menu_dashboard.dashboard_admin_cabang', compact(['data_activity']));
        } else { 
            return view('public_admin.menu_dashboard.dashboard', compact(['data_activity']));
        }
    }

    public function public_rs()
    {
        $role_id = session('pabi_role_id');
        session()->put('nama_menu_sidebar', 'dashboard');
        session()->put('nama_menu_header', 'Dashboard');

        $response = $this->guzzle('GET', 'activity', []);
        $response = json_decode($response->getBody()->getContents(), true);
        $data_activity = $response;
        // dd($data_activity);

        $ob = new PublicController();
        $ob->get_dashboard_rs();

        return view('public_admin.menu_dashboard.dashboard_rumah_sakit', compact(['data_activity']));
    }

    public function public_admin_member()
    {
        $response = $this->guzzle('GET', 'dashboard_member/'.session('pabi_member_id'), []);
        $response = json_decode($response->getBody()->getContents(), true);
        $data_member = $response['data'];
        // dd($data_member);
        $ob = new PublicController();
        $ob->get_dashboard_member($data_member);

        session()->put('nama_menu_sidebar', 'dashboard');
        session()->put('nama_menu_header', 'Dashboard');

        $nama_menu = 'Dashboard';

        $usecase = new GetNewestAnnouncementListUsecase($this->announcementRepository);
        $responseAnnouncement = $usecase->execute(2);

        if (!empty($responseAnnouncement->data)){
            $res = [];
            foreach ($responseAnnouncement->data['announcements'] as $announcementDomainModel){
               $announcementViewModel = new AnnouncementViewModel($announcementDomainModel);
               $res[] = $announcementViewModel;
            }
            $responseAnnouncement->data['announcements'] = $res;
        }
        
        return view('public_admin.menu_dashboard.dashboard_member',$responseAnnouncement->data
                , compact('nama_menu')); 
    }

    public function public_login()
    {
        if(Input::get('verif') == true) {
            Alert::success('Account anda telah terverifikasi, silahkan login.', 'Verify Success');
        }

        return view('public_login.index');
    }

    public function begin_forgot_password() {
        return view('public_login.email-forgot-password');
    }

    public function begin_post_forgot_password(Request $request) {
        $client = new Client();
        $base_url = env('URL_API');

        $response = $client->post($base_url.'forgot/password', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'form_params' => [
                'email' => $request->email
            ],
        ]);

        $res = json_decode((string) $response->getBody()->getContents(), true);
            
        if ($res['data'] == 'failed') {
            Alert::error($res['info'], 'Email Send Failed');

            return redirect('begin-forgot-password');
        }

        if ($res['data'] == 'success') {
            Alert::success('Silahkan check email anda.', 'Email Send Success');

            return redirect('login');
        }
    }

    public function reset_password($param) {
        $p = base64_decode($param);
        return view('public_login.forgot-password')->with('param', $p);
    }

    public function reset_password_post(Request $request) {
        $client = new Client();
        $base_url = env('URL_API');

        $response = $client->post($base_url.'reset/password', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password
            ],
        ]);

        $res = json_decode((string) $response->getBody()->getContents(), true);

        if ($res['data'] == 'success') {
            Alert::success('Password anda sudah diperbarui, silahkan login.', 'Password has update');
        }

        return redirect('login');
    }

    public function password_login(Request $request)
    {
        $check = DB::table('users')->where('email', session('email'))->first();
        
        if ($check->password !== '') {
            return redirect('/');
        } 

        return view('public_login.password_login');
    }

    public function public_member()
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
        $data_banner = MasterBanner::all();
        $data_tentang_pabi = MasterTentangPabi::all();

        // foreach ($data_banner as $data_banner) {}
        // foreach ($data_tentang_pabi as $data_tentang_pabi) {} 


        return view('public_member.menu_dashboard.dashboard'
            , compact('data_dashboard', 'data_banner', 'data_tentang_pabi, response->data')); 
    }

    public function updatePassword(Request $request) {
        $update = DB::table('users')->where('email', $request->email)->update([
            'password' => bcrypt($request->password),   
            // 'password_social' => Crypt::encrypt($request->password)
            'password_social' => base64_encode($request->password)
        ]);
        
        $client = new Client();
        $base_url = env('URL_API');
        
        if ($update) {
            $response = $client->post($base_url.'login/with/google', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'email' => $request->email
                ],
            ]);
    
            $res = json_decode((string) $response->getBody()->getContents(), true); 

            $user_id = $res['data']['user_id'];
            $check_member = Member::where('user_id', '=', $user_id)->first();

            if ($check_member == null) {
                Member::create([
                    'user_id' => $user_id
                ]);
            }

            $role_name = '';
            switch ($res['data']['role_id']) {
                case 1:
                    $role_name = 'Super Admin';
                break;
                case 2:
                    $role_name = 'Admin Pusat';
                break;
                case 3:
                    $role_name = 'Admin Cabang';
                break;
                case 4:
                    $role_name = 'Member';
                break;
                default:
                break;
            }
    
            session([
                'pabi_username' => $res['data']['username'],
                'pabi_user_id' => $res['data']['user_id'],
                'pabi_token_api' => 'Bearer '.$res['data']['token'],
                'pabi_role_id' => $res['data']['role_id'],
                'pabi_member_id' => $res['data']['member_id'],
                'pabi_role_name' => $role_name,
                'admin_cabang_id' => $res['data']['admin_cabang_id'],
                'admin_pusat_id' => $res['data']['admin_pusat_id']
            ]);        

            $response = $this->guzzle('GET', 'dashboard_member/'.session('pabi_member_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']; 

            $ob = new PublicController();
            $ob->get_dashboard_member($data_member);
    
            if (session('pabi_role_id') == 4) {
                return redirect()->route('dashboard_member');
            } else {
                return redirect()->route('dashboard_admin');
            }
        }
        
        return redirect('/');
    }

    public function get_dashboard_admin(){

        $role_id = session('pabi_role_id'); 
        if($role_id == 2 || $role_id == 1){ // admin PUSAT 
            $response = $this->guzzle('GET', 'dashboard_admin_pusat/'.session('admin_pusat_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data']; 
            
            $member_verif_belum = 0; 
            $member_verif_setuju = 0; 
            $member_verif_tolak = 0; 
            foreach ($data_member['grafik_member'] as $value) {
                // echo $value['pusat_verif'].'<br><br>';
                if($value['pusat_verif'] == 1){
                    $member_verif_belum = $value['jml'];
                } else if($value['pusat_verif'] == 2){
                    $member_verif_setuju = $value['jml'];
                } else if($value['pusat_verif'] == 3){
                    $member_verif_tolak = $value['jml'];
                }
            }

            $grafik_event_pusat = $data_member['grafik_event_pusat'];

            session([
                'pabi_member_verif_belum' => $member_verif_belum
                , 'pabi_member_verif_setuju' => $member_verif_setuju
                , 'pabi_member_verif_tolak' => $member_verif_tolak 

                , 'pabi_event_akan_datang_pusat' => $grafik_event_pusat['event_akan_datang_pusat']
                , 'pabi_event_belum_verif_bayar_pusat' => $grafik_event_pusat['event_belum_verif_bayar_pusat'] 

                , 'pabi_event_akan_datang_cabang_pusat' => $grafik_event_pusat['event_akan_datang_cabang_pusat']
                , 'pabi_event_belum_verif_bayar_cabang' => $grafik_event_pusat['event_belum_verif_bayar_cabang'] 

                , 'pabi_pindah_cabang_asal_belum_verif' 
                    => $grafik_event_pusat['pindah_cabang_asal_belum_verif'] 
                , 'pabi_pindah_cabang_asal_sudah_verif' 
                    => $grafik_event_pusat['pindah_cabang_asal_sudah_verif'] 

                , 'pabi_pindah_cabang_tujuan_belum_verif' 
                    => $grafik_event_pusat['pindah_cabang_tujuan_belum_verif'] 
                , 'pabi_pindah_cabang_tujuan_sudah_verif' 
                    => $grafik_event_pusat['pindah_cabang_tujuan_sudah_verif'] 

            ]);
        } else if($role_id == 3){ // admin CABANG  
            $response = $this->guzzle('GET', 'dashboard_admin_cabang/'.session('admin_cabang_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

            
            $member_verif_belum = 0; 
            $member_verif_setuju = 0; 
            $member_verif_tolak = 0; 
            foreach ($data_member['grafik_member'] as $value) {
                // echo $value['pusat_verif'].'<br><br>';
                if($value['cabang_verif'] == 1){
                    $member_verif_belum = $value['jml'];
                } else if($value['cabang_verif'] == 2){
                    $member_verif_setuju = $value['jml'];
                } else if($value['cabang_verif'] == 3){
                    $member_verif_tolak = $value['jml'];
                }
            }

            // dd($member_verif_belum);

            $grafik_event_cabang = $data_member['grafik_event_cabang'];

            session([
                'pabi_member_verif_belum' => $member_verif_belum
                , 'pabi_member_verif_setuju' => $member_verif_setuju
                , 'pabi_member_verif_tolak' => $member_verif_tolak 

                , 'pabi_event_akan_datang_cabang_pusat' => $grafik_event_cabang['event_akan_datang_cabang']

                , 'pabi_event_akan_datang_cabang' 
                    => $grafik_event_cabang['event_akan_datang_cabang']
                , 'pabi_event_selesai_cabang' 
                    => $grafik_event_cabang['event_selesai_cabang'] 
 
                , 'pabi_event_belum_verif_bayar_cabang' 
                    => $grafik_event_cabang['event_belum_verif_bayar_cabang'] 

                , 'pabi_borang_belum_verif_admin_cabang' 
                    => $grafik_event_cabang['borang_belum_verif_admin_cabang'] 
                , 'pabi_borang_setuju_verif_admin_cabang' 
                    => $grafik_event_cabang['borang_setuju_verif_admin_cabang'] 
                , 'pabi_borang_tolak_verif_admin_cabang' 
                    => $grafik_event_cabang['borang_tolak_verif_admin_cabang'] 

                , 'pabi_pindah_cabang_asal_belum_verif' 
                    => $grafik_event_cabang['pindah_cabang_asal_belum_verif'] 
                , 'pabi_pindah_cabang_asal_sudah_verif' 
                    => $grafik_event_cabang['pindah_cabang_asal_sudah_verif'] 

                , 'pabi_pindah_cabang_tujuan_belum_verif' 
                    => $grafik_event_cabang['pindah_cabang_tujuan_belum_verif'] 
                , 'pabi_pindah_cabang_tujuan_sudah_verif' 
                    => $grafik_event_cabang['pindah_cabang_tujuan_sudah_verif'] 


            ]);
        } else { // SUPERADMIN 

        }
    }

    public function get_dashboard_rs()
    {
        $response = $this->guzzle('GET', 'dashboard_rs/'.session('pabi_rs_id'), []);
        $response = json_decode($response->getBody()->getContents(), true);
        $data_rs = $response['data'];

        $grafik_rs = $data_rs['grafik_rs'];

        session([
            'pabi_borang_belum_verif_rs' 
            => $grafik_rs['borang_belum_verif_rs'] 
            , 'pabi_borang_setuju_verif_rs' 
            => $grafik_rs['borang_setuju_verif_rs'] 
            , 'pabi_borang_tolak_verif_rs' 
            => $grafik_rs['borang_tolak_verif_rs'] 
        ]);
    }

    public function get_dashboard_member($data_member){

        if(empty($data_member['borang_proses'])) { $data_member['borang_proses']=0; }
        if(empty($data_member['borang_disetujui'])) { $data_member['borang_disetujui']=0; }
        if(empty($data_member['borang_ditolak'])) { $data_member['borang_ditolak']=0; }
        session([
            'pabi_gender' => $data_member['gender']
            , 'pabi_cabang_verif' => $data_member['cabang_verif']
            , 'pabi_pusat_verif' => $data_member['pusat_verif']
            , 'pabi_image' => $data_member['image_thumb']
            , 'pabi_image_compress' => $data_member['image_thumb_compress']

            , 'pabi_event_menunggu_bayar' => $data_member['event_menunggu_bayar']
            , 'pabi_event_akan_datang' => $data_member['event_akan_datang']
            , 'pabi_pusat_nama' => $data_member['admin_pusat_nama']
            , 'pabi_cabang_nama' => $data_member['admin_cabang_nama']
            
            , 'pabi_min_poin' => $data_member['min_poin']

            , 'pabi_poin_total' => $data_member['poin_total']
            , 'pabi_poin_belum_verif' => $data_member['poin_belum_verif']
            , 'pabi_poin_setuju_verif' => $data_member['poin_setuju_verif']
            , 'pabi_poin_tolak_verif' => $data_member['poin_tolak_verif']

            , 'pabi_borang_proses' => $data_member['borang_proses']
            , 'pabi_borang_disetujui' => $data_member['borang_disetujui']
            , 'pabi_borang_ditolak' => $data_member['borang_ditolak']
        ]);
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
