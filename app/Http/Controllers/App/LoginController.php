<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\ClientsLogin;

class LoginController extends Controller
{

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request) {

        return view ('site.signin');

    }


    /**
     * autenticate
     *
     * @param  mixed $request
     * @return void
     */
    public function autenticate(Request $request) {

       // Validator Rules
       $rules = [
            'email' => 'email:rfc',
            'password' => 'required|min:6',
        ];

        // Validator Feedback
        $feedback = [
            'email' => "Você precisa informar um e-mail válido.",
            'password' => "O password é obrigatório e deve conter no mínimo 6 caracteres."
        ];

        // Execute Validation
        Validator::make($request->all(), $rules, $feedback)->validate();

        $email = $request->input('email');
        $password = $request->input('password');

        // Verify if User Exists
        $verify = DB::table('clients')->where('email', $email)->get()->first();

        if(isset($verify->id)) {

            if(Hash::check($password, $verify->password)) {

                session_start();

                // Generate UUID / Token
                $token = Str::uuid();

                // Remove Previuosly Login Data
                ClientsLogin::where('client_id', $verify->id)->delete();

                // Create Login Point
                ClientsLogin::create(['client_id' => $verify->id, 'token' => $token]);

                // Set User Session
                $_SESSION[md5('clientId')] = base64_encode($verify->id);
                $_SESSION[md5('clientToken')] = base64_encode($token);
                $_SESSION[md5('clientName')] = base64_encode($verify->name);

                // Auth Cookies
                setcookie(self::cookieKey(), md5($verify->id));
                setcookie(self::cookieToken(), $token);

                // Send Notify
                session()->flash('notifyType', 'success-login');

                // Redirect
                return redirect()->route('app.index');

            }
            else {

                // Send Notify
                session()->flash('notifyType', 'error-password');

                // Redirect
                return redirect()->route('site.signin');

            }

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'error-email');

            // Redirect
            return redirect()->route('site.signin');

        }

    }


    /**
     * getId
     */
    public static function getId() {

        return base64_decode($_SESSION[md5('clientId')]);

    }


    /**
     * getName
     */
    public static function getName() {

        return base64_decode($_SESSION[md5('clientName')]);

    }


    /**
     * getImage
     */
    public static function getImage() {

        $profile = Client::select(['id', 'image'])->where('id', self::getId())->get()->first();

        if(isset($profile->id)) {

            return ($profile->image != '' && !is_null($profile->image)) ? $profile->image : '';

        }
        else {

            return '';

        }

    }


    /**
     * cookieKey
     */
    public static function cookieKey() {

        return 'AuthKeyClientCK';

    }


    /**
     * cookieToken
     */
    public static function cookieToken() {

        return 'AuthTokenClientCK';

    }


    /**
     * apiHeaders
     *
     * @return void
     */
    public static function apiHeaders() {

        return [
            'Auth-Key' => $_COOKIE[self::cookieKey()],
            'Auth-Token' => $_COOKIE[self::cookieToken()]
        ];

    }


    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout (Request $request) {

        @session_start();

        $keyId = md5('clientId');
        $keyToken = md5('clientToken');
        $keyName = md5('clientName');

        if(isset($_SESSION[$keyId]) && isset($_SESSION[$keyToken])) {

            // Verify User Login
            $clientLogin = new ClientsLogin();
            $verify = $clientLogin->where('client_id', base64_decode($_SESSION[$keyId]))->where('token', base64_decode($_SESSION[$keyToken]))->get()->first();

            if(isset($verify->id)) {

                // Delete Login Point
                DB::table("clients_logins")->where("id", $verify->id)->where("client_id", $verify->client_id)->delete();

            }

            // Unset Cookie
            setcookie(self::cookieKey(), '', time() - 3600);
            setcookie(self::cookieToken(), '', time() - 3600);

            // Delete User Session
            unset($_SESSION[$keyId], $_SESSION[$keyToken], $_SESSION[$keyName]);

            // Send Notify
            session()->flash('notifyType', 'logout');

            // Redirect
            return redirect()->route('site.signin');

        }

    }

}
