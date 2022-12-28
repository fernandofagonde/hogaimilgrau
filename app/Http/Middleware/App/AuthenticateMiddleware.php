<?php

namespace App\Http\Middleware\App;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\App\LoginController;

use App\Models\Client;
use App\Models\ClientsLogin;

class AuthenticateMiddleware
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

        session_start();

        $keyId = md5('clientId');
        $keyToken = md5('clientToken');

        if(isset($_SESSION[$keyId]) && isset($_SESSION[$keyToken])) {

            $userLogin = new ClientsLogin();
            $verify = $userLogin->where('client_id', base64_decode($_SESSION[$keyId]))->where('token', base64_decode($_SESSION[$keyToken]))->get()->first();

            if(isset($verify->id)) {

                DB::table("clients_logins")->where("id", "<>", $verify->id)->where("client_id", $verify->user_id)->delete();

                return $next($request);

            }
            else {

                // Send Notify
                session()->flash('notifyType', 'logout');

                return redirect()->route('site.signin');

            }

        }
        else if($request->hasHeader('Auth-Key') && $request->hasHeader('Auth-Token')) {

            $verify = $verify = Client::select(['id'])
            ->whereRaw('MD5(client_id) = :akey AND token = :atoken', [ 'akey' => $request->hasHeader('Auth-Key'), 'atoken' => $request->hasHeader('Auth-Token') ])
            ->get()
            ->first();
            //DB::select('SELECT id FROM clients WHERE MD5(client_id) = :akey AND token = :atoken LIMIT 1', [ 'akey' => $request->hasHeader('Auth-Key'), 'atoken' => $request->hasHeader('Auth-Token') ])->first();

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

            // Send Notify
            session()->flash('notifyType', 'error-login');

            return redirect()->route('site.signin');

        }

    }
}
