<?php

namespace App\Http\Middleware\Admin;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\LoginController;

use App\Models\LogAcesso;
use App\Models\UsersLogin;

class AuthenticateApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->hasHeader('Auth-Key') && $request->hasHeader('Auth-Token')) {

            $verify = DB::select('SELECT id FROM users WHERE MD5(user_id) = :akey AND token = :atoken LIMIT 1', [ 'akey' => $request->hasHeader('Auth-Key'), 'atoken' => $request->hasHeader('Auth-Token') ])->first();

            if(isset($verify->id)) {

                return $next($request);

            }
            else {

                return response()->json([
                    'error' => true,
                    'error-code' => 'identification-error'
                ]);

            }

        }
        else {

            return response()->json([
                'error' => true,
                'error-code' => 'identification-error'
            ]);

        }

        // if(isset($_SESSION[$keyId]) && isset($_SESSION[$keyToken])) {

        //     $userLogin = new UsersLogin();
        //     $verify = $userLogin->where('user_id', base64_decode($_SESSION[$keyId]))->where('token', base64_decode($_SESSION[$keyToken]))->get()->first();

        //     if(isset($verify->id)) {

        //         DB::table("users_logins")->where("id", "<>", $verify->id)->where("user_id", $verify->user_id)->delete();

        //         return $next($request);

        //     }
        //     else {

        //         return redirect()->route('site.login', [ 'notifyType' => 'logout' ] );

        //     }

        // }
        // else {

        //     return redirect()->route('site.login', [ 'notifyType' => 'error-login' ]);

        // }

    }
}
