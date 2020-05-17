<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
use App\Member;
use App\Activity;
use DB;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use App\Support\Guzzle\GuzzleBase;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/password';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function findOrCreate($user, $provider) {
        $auth = User::where('provider_id', $user->id)->first();

        if($auth) {
            return $auth;
        }

        $users = User::where('email', $user->email);

        if ($users->exists()) {
            return $users->update([
                // 'username' => $user->name,
                'username' => strtolower($user->email),
                'email' => $user->email,
                'provider' => strtoupper($provider),
                'provider_id' => $user->id
            ]);
        } else {
            return User::create([
                // 'username' => $user->name,
                'username' => strtolower($user->email),
                'email' => $user->email,
                'provider' => strtoupper($provider),
                'provider_id' => $user->id,
                'status_active' => 1,
                'role_id' => 4
            ]);
        }
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->stateless()->user();
        $checkUser = User::where('email', $user->email)->first();
        $userSaveOrFind = $this->findOrCreate($user, $provider);

        if($checkUser) {
            Auth::login($checkUser, true);
        } else {
            Auth::login($userSaveOrFind, true);
        }

        $email = $user->email;
        $base_url = env('URL_API');

        if ($email !== null || $email !== '') {
            $client = new Client();

            $check_pass = User::where('email', '=', $email)->get();
            $user_id = $check_pass[0]->id;
            $check_member = Member::where('user_id', '=', $user_id)->first();

            $firstnameLower = strtolower($user->email);
            $firstname = substr($firstnameLower, 0, strpos($firstnameLower, "@"));

            if ($check_member == null) {
                Member::create([
                    'user_id' => $user_id,
                    'firstname' => $firstname
                ]);
            }

            if ($check_pass[0]->password == '' || $check_pass[0]->password_social == '') {
                return redirect()->route('password.log')->with('email', $email);
            } else {
                try {
                    $response = $client->post($base_url.'login/with/google', [
                        'headers' => [
                            'Accept' => 'application/json'
                        ],
                        'form_params' => [
                            'email' => $user->email
                        ],
                    ]);

                    $res = json_decode((string) $response->getBody()->getContents(), true);
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
                        case 5:
                            $role_name = 'Rumah Sakit';
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

                    $response = $this->guzzle('GET', 'member/'.session('pabi_member_id'), []);
                    $response = json_decode($response->getBody()->getContents(), true);
                    $data_member = $response['data'];

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
                    ]);

                    if (session('pabi_role_id') == 4) {
                        return redirect()->route('dashboard_member');
                    } else if (session('pabi_role_id') == 5) {

                        $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth/user/'.$id, []);
                        $response = json_decode($response->getBody()->getContents(), true);
                        $data_rs = $response['data'];

                        session([
                            'pabi_rs_id' => $data_rs['id']
                            , 'pabi_image' => $data_rs['img_logo']
                            , 'pabi_image_compress' => $data_rs['img_logo']
                        ]);

                        return redirect()->route('dashboard_rs');
                    } else {
                        return redirect()->route('dashboard_admin');
                    }
                } catch (ClientException $e) {
                    $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
                    $message = $errors['info'];

                    return redirect()->back()->withErrors($message);
                }
            }
        }
    }

    public function login(Request $request)
    {
        $http = new Client();

        try {
            $base_url = env('URL_API');
            $token = request()->session()->get('token');

            $response = $http->post($base_url.'login', [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Authorization' => $token
                ],
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password
                ],
            ]);

            $res = json_decode((string) $response->getBody()->getContents(), true);
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
                case 5:
                $role_name = 'Rumah Sakit';
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

            $response = $this->guzzle('GET', 'member/'.session('pabi_member_id'), []);
            $response = json_decode($response->getBody()->getContents(), true);
            $data_member = $response['data'];

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
            ]);

            if (session('pabi_role_id') == 4) {
                return redirect()->route('dashboard_member');
            } else if (session('pabi_role_id') == 5) {

                $response = $this->guzzle('GET', 'rumah-sakit/not-member/not-auth/user/'.session('pabi_user_id'), []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_rs = $response['data'];

                session([
                    'pabi_rs_id' => $data_rs['id']
                    , 'pabi_image' => $data_rs['img_logo']
                    , 'pabi_image_compress' => $data_rs['img_logo']
                ]);

                return redirect()->route('dashboard_rs');
            } else {
                return redirect()->route('dashboard_admin');
            }

        } catch (ClientException $e) {
            $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
            $message = $errors['info'];

            return redirect()->back()->withErrors($message);
        }
    }

    function logout_admin()
    {
        request()->session()->flush();

        return redirect()->route('dashboard_admin');
    }

    function logout() {
        $id = request()->session()->get('pabi_user_id');
        DB::table('activity')->where('user_id', $id)->update([
            'status_online' => 0
        ]);

        request()->session()->flush();

        return redirect()->route('dashboard_admin');
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
