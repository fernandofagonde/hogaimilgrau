<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SendEmailController;

use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyMail;

use App\Models\Client;

class ClientsController extends Controller
{

    protected $redirectRoute = 'site.signin';

    /**
     * remember
     *
     * @param  mixed $request
     * @return void
     */
    public function recovery(Request $request) {

        /**
         * Validator Rules
         */

        $rules = [
            'email' => 'required|email'
        ];

        /**
         * Validator Feedback
         */

        $feedback = [
            'email.required' => "O campo E-mail é obrigatório.",
            'email.email' => "O campo E-mail é inválido, verifique-o."
        ];

        // Execute Validation
        Validator::make($request->all(), $rules, $feedback)->validate();

        $user = DB::table('clients')->select(['id', 'name', 'email'])->where('email', $request->input('email'))->get()->first();

        if(isset($user->id)) {

            $faker = \Faker\Factory::create();

            $mailData = [
                'subject' => 'Hogai - Recuperação de Senha',
                'title' => 'Recuperação de Senha de Acesso',
                'body' => 'Você solicitou a recuperação de sua senha de acesso, porém por questões de segurança nós geramos uma nova senha, disponível abaixo:<br>
                <div id="password-box">'. $faker->randomNumber(6, true) .'<br>Lembre-se de alterá-la em seu primeira acesso.<br><br>
                Atenciosamente,<br>
                '. env('APP_NAME')
            ];

            Mail::to(['address' => $user->email])->send(new NotifyMail($mailData));

            if (Mail::failures()) {

                // Send Notify
                session()->flash('notifyType', 'recovery-mail-error');

                return redirect()->route($this->redirectRoute);


            } else {

                // Send Notify
                session()->flash('notifyType', 'recovery-success');

                return redirect()->route($this->redirectRoute);

            }

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'recovery-not-found');

            return redirect()->route($this->redirectRoute);

        }

    }

}
