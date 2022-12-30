<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
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
        'password.same' => "O campo Password e Repita o Password não correspondem.",
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
    public function edit($client)
    {
        $_client = Client::where('id', $client)->get()->first();

        if(isset($_client->id)) {

            return view($this->viewPath . 'edit', ['client' => $_client]);

        }
        else {

            // Return Message
            session()->flash('notifyType', 'not-found');

            // Return Redirect
            return redirect()->route($this->routePath . 'index');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client)
    {
        // Client ID
        $clientId = $client;

        // Update Validation Rules
        $rules = $this->rules;
        $rules['email'] .= ',email,'. $clientId;
        $rules['document'] .= ',document,'. $clientId;

        if(strlen($request->input('password')) > 0) {

            $rules['password'] = 'min:6|max:12|same:retype_password';
            $rules['retype_password'] = 'min:6|max:12|same:password';

        }

        // Execute Validation
        Validator::make($request->all(), $rules, $this->feedback)->validate();

        $client = Client::where('id', $clientId)->get()->first();

        if(isset($client->id)) {

            $client->status = $request->input('status');
            $client->name = $request->input('name');
            $client->document_type = $request->input('document_type');
            $client->document = $request->input('document');
            $client->phone = $request->input('phone');
            $client->phone_whatsapp = $request->input('phone_whatsapp');
            $client->city = $request->input('city');
            $client->uf = $request->input('uf');
            $client->email = $request->input('email');

            $passwordUpdated = false;

            if(strlen($request->input('password')) >= 6 &&  strlen($request->input('password')) <= 12 && $request->input('password') === $request->input('retype_password')) {

                $client->password = Hash::make($request->input('password'));

                $passwordUpdated = true;

            }

            if($request->hasFile('image')) {

                $file = $request->file('image');

                $path = public_path("content/app/profile");

                $fileExtension = $file->getClientOriginalExtension();

                if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {

                    // Delete Billet
                    if($client->image != '' && !is_null($client->image)) {

                        @unlink($path .'/'. $client->image);

                    }

                    $fileName = 'profile-'. $clientId .'-'. Str::uuid() .'.webp';

                    $file->move(public_path('content/temp'), $file->getClientOriginalName());
                    $tempfile = public_path('content/temp') .'/'. $file->getClientOriginalName();

                    $client->image = $fileName;

                    // Initiate Manager
                    $manager = new ImageManager('gd');

                    // Make Large File
                    $largeFile = $manager->make($tempfile);
                    $largeFileDims = [ 400, 300 ];

                    // Make Thumb File
                    $thumbFile = $largeFile;
                    $thumbFileDims = [ 120, 90 ];

                    // Original Width and Height
                    $originalWidth = $largeFile->getWidth();
                    $originalHeight = $largeFile->getheight();

                    // Reverse Dims if Portrait
                    if($originalWidth < $originalHeight) {

                        array_reverse($largeFileDims);

                    }

                    // Save Large
                    $largeFile->scale($largeFileDims[0], $largeFileDims[1]);
                    $largeFile->toWebp(100)->save($path . '/large/'. $fileName);

                    // Save Thumb
                    $thumbFile->scale($thumbFileDims[0], $thumbFileDims[1]);
                    $thumbFile->toWebp(100)->save($path . '/thumb/'. $fileName);

                    unset($largeFile, $thumbFile);

                    unlink($tempfile);

                }

            }

            $client->save();

            // Get First Name
            $_n = explode(' ', $client->name);

            // Prepare Message
            $mailData = [
                'subject' => 'Admin Hogai - Dados Atualizados',
                'title' => 'Seus dados foram atualizados',
                'body' => '<strong id="client-name">Olá '. $_n[0] .'</strong><br>
                Seu cadastro foi alterado e para garantir seu acesso ao Painel Administrativo estamos lhe encaminhando os dados de acesso atualizados:<br>
                <div id="info-box">
                    <strong>URL</strong>'. $request->url('admin') .'<br>
                    <strong>E-mail</strong>'. $request->input('email') .'<br>
                    <strong>Senha</strong>'. (($passwordUpdated) ? $request->input('password') : 'Não alterada') .'
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
            session()->flash('notifyType', 'success-edit');

            // Log Action
            UsersLogController::create('Alterou Cliente #'. $clientId);

            // Return Redirect
            return redirect()->route($this->routePath . 'index');

        }
        else {

            session()->flash('notifyType', 'not-found');

            // Return Redirect
            return redirect()->route($this->routePath . 'index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client)
    {
        $client = Client::select(['id', 'image'])->where('id', $client)->get()->first();

        if(isset($client->id)) {

            // Delete Image
            if($client->image != '' && !is_null($client->image)) {

                @unlink(public_path("content/app/profile/thumb") .'/'. $client->image);
                @unlink(public_path("content/app/profile/large") .'/'. $client->image);

            }

            $client->delete();

            // Send Notify
            session()->flash('notifyType', 'success-del');

            return redirect()->route($this->routePath . 'index');

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'not-permited');

            return redirect()->route($this->routePath . 'index');

        }
    }

}
