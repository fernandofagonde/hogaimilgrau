<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyAdmin;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UsersLogController;

use App\Models\Client;

class ClientsController extends Controller
{

    /**
     * Common Vars
     */

    var $routePath = 'admin.clients.';
    var $viewPath = 'admin.clients.';

    /**
     * Validator Rules
     */

    var $rules = [
        'name' => 'required|min:5|max:190',
        'document' => 'required|min:14|max:20|unique:clients',
        'phone' => 'required|min:14|max:15',
        'city' => 'required|min:3|max:150',
        'email' => 'required|email|unique:clients'
    ];

    /**
     * Validator Feedback
     */

    var $feedback = [
        'name.required' => "O campo Nome é obrigatório.",
        'document.required' => "O campo Documento é obrigatório.",
        'phone.required' => "O campo Telefone é obrigatório.",
        'city.required' => "O campo Cidade é obrigatório.",'email.required' => "O campo E-mail é obrigatório.",
        'email.email' => "O e-mail informado é inválido.",
        'email.unique' => "O e-mail informado já está em uso.",
        'password.required' => "O campo Password é obrigatório.",
        'password.min' => "O campo Password deve conter entre 6 e 12 caracteres.",
        'password.max' => "O campo Password deve conter entre 6 e 12 caracteres.",
        'retype_password.min' => "O campo Repita o Password deve conter entre 6 e 12 caracteres.",
        'retype_password.max' => "O campo Repita o Password deve conter entre 6 e 12 caracteres.",
        'retype_password.same' => "O campo Password e Repita o Password não correspondem."
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('clients')
            ->orderBy('name')
            ->paginate(25);

        $parameters = [
            'items' => $items
        ];

        return view($this->viewPath . 'index', $parameters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewPath . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Update Validation Rules
        $rules = $this->rules;
        $rules['password'] = 'required|min:6|max:12|same:retype_password';
        $rules['retype_password'] = 'required|min:6|max:12';

        // Execute Validation
        Validator::make($request->all(), $this->rules, $this->feedback)->validate();

        // Save
        $client = new Client;
        $client->status = $request->input('status');
        $client->name = $request->input('name');
        $client->document_type = $request->input('document_type');
        $client->document = $request->input('document');
        $client->phone = $request->input('phone');
        $client->phone_whatsapp = $request->input('phone_whatsapp');
        $client->city = $request->input('city');
        $client->uf = $request->input('uf');
        $client->image = '';
        $client->email = $request->input('email');
        $client->password = Hash::make($request->input('password'));
        $client->save();

        // Get First Name
        $_n = explode(' ', $client->name);

        // Prepare Message
        $mailData = [
            'subject' => 'Admin Hogai - Seja Bem-Vindo(a)',
            'title' => 'Seja Bem-Vindo(a)',
            'body' => '<strong id="client-name">Olá '. $_n[0] .'</strong><br>
            Você foi cadastrado(a) como administrador da Plataforma Hogai e para acessar o Painel Administrativo basta utilizar
            os dados disponíveis abaixo:
            <div id="info-box">
                <ul>
                    <li><strong>URL</strong><div>'. $request->url('admin') .'</div></li>
                    <li><strong>E-mail</strong><div>'. $request->input('email') .'</div></li>
                    <li><strong>Senha</strong><div>'. $request->input('password') .'</div></li>
                </ul>
            </div>
            Atenciosamente,<br>
            <strong>'. config('app.admin_name') .'</strong>'
        ];

        // Send E-mail
        Mail::to(['address' => $client->email])->send(new NotifyAdmin($mailData));

        if (Mail::failures()) {

            // Send Notify
            session()->flash('notifyType', 'notify-mail-error');


        } else {

            // Send Notify
            session()->flash('notifyType', 'notify-mail-success');

        }

        // Send Notify
        session()->flash('notifyType', 'success-add');

        // Log Action
        UsersLogController::create('Criou Cliente #' . $client->id);

        // Return Redirect
        return redirect()->route($this->routePath . 'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
