<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use App\Support\Guzzle\GuzzleBase;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {   
        //echo "string";
        //echo $request->username . $request->email . $request->password . $request->password_confirmation;
        //exit();
        $client = new \GuzzleHttp\Client();
        
        try{
            $response = $this->guzzle('POST','register',[
                'username' => $request->username, 
                'email' => $request->email, 
                'password' => $request->password, 
                'password_confirmation' => $request->password_confirmation, 
                'role_id' => "4"

            ]);

            $response = json_decode($response->getBody()->getContents(), true);
            $msg = "";
            if (isset($response['data'])) {
                $role_name = '';
                switch ($response['data']['role_id']) {
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
                    'pabi_username' => $response['data']['username'],
                    'pabi_user_id' => $response['data']['user_id'],
                    'pabi_token_api' => 'Bearer '.$response['data']['token'],
                    'pabi_role_id' => $response['data']['role_id'],
                    'pabi_member_id' => $response['data']['member_id'],
                    'pabi_role_name' => $role_name,
                    'admin_cabang_id' => $response['data']['admin_cabang_id'],
                    'admin_pusat_id' => $response['data']['admin_pusat_id']
                ]); 

                $response = $this->guzzle('GET', 'member/'.session('pabi_member_id'), []);
                $response = json_decode($response->getBody()->getContents(), true);
                $data_member = $response['data'];

                session([
                    'pabi_cabang_verif' => $data_member['cabang_verif'],
                    'pabi_pusat_verif' => $data_member['pusat_verif'],
                    'pabi_image' => $data_member['image_thumb']
                ]);
                
            } else {
                foreach ($response['errors'] as $rErrors) {
                    $msg .= $rErrors[0] . " 
                    ";
                }
            }
            if ($msg == "") {
                if (session('pabi_role_id') == 4) {
                    return redirect()->route('dashboard_member');
                } else {
                    return redirect()->route('dashboard_admin');
                }
            } else {
                return redirect()->back()->withErrors($msg);
            }
        }
        catch(RequestException $e){
                //mengambil pesan error dan merubah json ke array
            $response = json_decode($e->getResponse()->getBody()->getContents(),true);

            //print_r($response);
            $message = $response['info'];

            return redirect()->back()->withErrors($message);
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

}
