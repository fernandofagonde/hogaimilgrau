<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // Get Client
        $client = Client::select(['id', 'name', 'email'])->where('email', $request->input('email'))->get()->first();

        if(isset($client->id)) {

            // Start Faker Lib
            $faker = \Faker\Factory::create();

            // Get First Name
            $_n = explode(' ', $client->name);

            // New Random Password
            $password = $faker->regexify('[A-Za-z0-9]{8}');

            // Update Data on DB
            $client->password = Hash::make($password);
            $client->updated_at = date('Y-m-d H:i:s');
            $client->save();

            // Prepare Message
            $mailData = [
                'subject' => 'Hogai - Recuperação de Senha',
                'title' => 'Recuperação de Senha de Acesso',
                'body' => '<strong id="client-name">Olá '. $_n[0] .'</strong><br>Você solicitou a recuperação de sua senha de acesso, porém, por questões de segurança, nós geramos uma nova senha aleatória que
                indicamos que seja alterada para outra de sua preferência em seu primeiro login. Sua nova senha está abaixo:<br>
                <div id="password-box">'. $password .'</div><br>Lembre-se de alterá-la em seu primeira acesso, no menu "Minha Conta".<br><br>
                Atenciosamente,<br>
                <strong>'. config('app.client_name') .'</strong>'
            ];

            // Send E-mail
            Mail::to(['address' => $client->email])->send(new NotifyMail($mailData));

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
