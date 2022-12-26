<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\App\LoginController;
use App\Http\Controllers\App\ClientsLogController;

use App\Models\People;

class PeopleController extends Controller
{

    /**
     * Common Vars
     */

    var $routePath = 'app.people.';
    var $viewPath = 'app.people.';

    /**
     * Validator Rules
     */

    var $rules = [
        'type' => 'required',
        'name' => 'required|min:5|max:190',
        'document_type' => 'required|min:3',
        'document' => 'required|min:14|max:20|unique:people',
        'email' => 'required|email|unique:people',
        'phone' => 'required|min:14|max:15'
    ];

    /**
     * Validator Feedback
     */

    var $feedback = [
        'type.required' => "O campo Tipo é obrigatório.",
        'name.required' => "O campo Nome é obrigatório.",
        'document_type.required' => "O campo Tipo de Documento é obrigatório.",
        'document.required' => "O campo Documento é obrigatório.",
        'email.required' => "O campo E-mail é obrigatório.",
        'phone.required' => "O campo Telefone é obrigatório."
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('people')
            ->where('client_id', LoginController::getId())
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
        // Execute Validation
        Validator::make($request->all(), $this->rules, $this->feedback)->validate();

        // Save
        $people = new People;
        $people->client_id = LoginController::getId();
        $people->type = $request->input('type');
        $people->name = $request->input('name');
        $people->document_type = $request->input('document_type');
        $people->document = $request->input('document');
        $people->email = $request->input('email');
        $people->phone = $request->input('phone');
        $people->phone_whatsapp = $request->input('phone_whatsapp');
        $people->save();

        // Send Notify
        session()->flash('notifyType', 'success-add');

        // Log Action
        ClientsLogController::create('Criou Pessoa #' . $people->id);

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
    public function edit($person)
    {
        $people = People::where('client_id', LoginController::getId())->where('id', $person)->get()->first();

        return view($this->viewPath . 'edit', [ 'people' => $people ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $person)
    {
        // Update Validation Rules
        $rules = $this->rules;
        $rules['document'] .= ',document,'. $person;
        $rules['email'] .= ',email,'. $person;

        // Execute Validation
        Validator::make($request->all(), $rules, $this->feedback)->validate();

        $people = People::where('client_id', LoginController::getId())->where('id', $person)->get()->first();

        $people->type = $request->input('type');
        $people->name = $request->input('name');
        $people->document_type = $request->input('document_type');
        $people->document = $request->input('document');
        $people->email = $request->input('email');
        $people->phone = $request->input('phone');
        $people->phone_whatsapp = $request->input('phone_whatsapp');

        $people->save();

        // Send Notify
        session()->flash('notifyType', 'success-edit');

        // Log Action
        ClientsLogController::create('Editou Pessoa #' . $people->id);

        // Return Redirect
        return redirect()->route($this->routePath . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($person)
    {
        $people = People::select(['id', 'image'])->where('client_id', LoginController::getId())->where('id', $person)->get()->first();

        if(isset($people->id)) {

            // Delete Image
            if($people->image != '' && !is_null($people->image)) {

                @unlink(public_path("content/app/profile/thumb") .'/'. $people->image);
                @unlink(public_path("content/app/profile/large") .'/'. $people->image);

            }

            $people->delete();

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

    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request) {

        if($request->has('keywords')) {

            // Validator Rules
            $privateRules = [
                'keywords' => 'required|min:3|max:40'
            ];

            // Validator Feedback
            $privateFeedback = [
                'keywords.required' => "Informe as palavras-chave para a busca.",
            ];

            // Execute Validation
            Validator::make($request->all(), $privateRules, $privateFeedback)->validate();

            $kwd = $request->input('keywords');

            $items = DB::table('people')
            ->where('client_id', LoginController::getId())
            ->where(function($query) use ($kwd) {
                $query->where('name', 'LIKE', "%{$kwd}%")
                ->orWhere('document', 'LIKE', "%{$kwd}%")
                ->orWhere('email', 'LIKE', "%{$kwd}%");
            })
            ->orderBy('name')
            ->paginate(25);

            $parameters = [
                'items' => $items,
                'request' => $request
            ];

            return view($this->viewPath . 'search', $parameters);

        }
        else {

            return redirect()->route($this->routePath . 'index');

        }

    }


}
