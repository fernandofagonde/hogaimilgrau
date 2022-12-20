<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UsersLogin;

class LoginController extends Controller
{

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request) {

        return view ('site.login');

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

        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User();

        // Verify if User Exists
        $verify = $user->where('email', $email)->get()->first();

        if(isset($verify->id)) {

            if(Hash::check($password, $verify->password)) {

                session_start();

                // Generate UUID / Token
                $token = Str::uuid();

                // Create Login Point
                UsersLogin::create(['user_id' => $verify->id, 'token' => $token]);

                // Set User Session
                $_SESSION[md5('userId')] = base64_encode($verify->id);
                $_SESSION[md5('userToken')] = base64_encode($token);
                $_SESSION[md5('userName')] = base64_encode($verify->name);

                // Auth Cookies
                setcookie(self::cookieKey(), md5($verify->id));
                setcookie(self::cookieToken(), $token);

                // Send Notify
                session()->flash('notifyType', 'success-login');

                // Redirect
                return redirect()->route('admin.index');

            }
            else {

                // Send Notify
                session()->flash('notifyType', 'error-password');

                // Redirect
                return redirect()->route('site.login');

            }

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'error-email');

            // Redirect
            return redirect()->route('site.login');

        }

    }


    /**
     * getId
     *
     * @return void
     */
    public static function getId() {

        return base64_decode($_SESSION[md5('userId')]);

    }


    /**
     * getName
     *
     * @return void
     */
    public static function getName() {

        return base64_decode($_SESSION[md5('userName')]);

    }


    /**
     * getType
     *
     * @return void
     */
    public static function getType() {

        return 'Administrador';

    }

    public static function cookieKey() {

        return 'AuthKeyCK';

    }

    public static function cookieToken() {

        return 'AuthTokenCK';

    }


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

        $keyId = md5('userId');
        $keyToken = md5('userToken');
        $keyName = md5('userName');

        if(isset($_SESSION[$keyId]) && isset($_SESSION[$keyToken])) {

            // Verify User Login
            $userLogin = new UsersLogin();
            $verify = $userLogin->where('user_id', base64_decode($_SESSION[$keyId]))->where('token', base64_decode($_SESSION[$keyToken]))->get()->first();

            if(isset($verify->id)) {

                // Delete Login Point
                DB::table("users_logins")->where("id", $verify->id)->where("user_id", $verify->user_id)->delete();

            }

            // Unset Cookie
            setcookie('AuthToken', '', time() - 3600);

            // Delete User Session
            unset($_SESSION[$keyId], $_SESSION[$keyToken], $_SESSION[$keyName]);

            // Send Notify
            session()->flash('notifyType', 'logout');

            // Redirect
            return redirect()->route('site.login');

        }

    }

}
