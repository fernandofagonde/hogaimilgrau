<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Http\Controllers\App\LoginController;
use App\Http\Controllers\App\ClientsLogController;

use App\Models\ReceivableBill as Bill;

class ReceivableBillsController extends Controller
{

    /**
     * Common Vars
     */

    var $routePath = 'app.receivable-bills.';
    var $viewPath = 'app.receivable_bills.';

    /**
     * Validator Rules
    */

    var $rules = [
        'status' => 'required',
        'title' => 'required|min:5|max:190',
        'amount' => 'required|between:1.00,9999999999.99',
        'payday' => 'required|date_format:Y-m-d'
    ];

    /**
     * Validator Feedback
    */

    var $feedback = [
        'status.required' => "O campo Status é obrigatório.",
        'title.required' => "O campo Título é obrigatório.",
        'amount.required' => "O campo Valor é obrigatório.",
        'payday.required' => "O campo Data de Pagamento é obrigatório.",
        'payday.date_format' => "O campo Data de Pagamento é inválido."
    ];

    /**
     * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $items = DB::table('receivable_bills')
            ->select(['receivable_bills.*', (DB::raw("COALESCE((SELECT p.name FROM people p WHERE p.id = receivable_bills.people_id), '-') AS people_name"))])
            ->where('receivable_bills.client_id', LoginController::getId())
            ->orderByDesc('receivable_bills.payday')
            ->paginate(1);

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
        $peopleList = $this->peopleList();

        return view($this->viewPath . 'create', [ 'peopleList' => $peopleList ]);
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

        // Format Money
        $request->merge([ 'amount' => \Main::moneySQL($request->input('amount')) ]);

        // Return Method
        $return = $request->input('_return');

        // Save
        $bill = new Bill;
        $bill->client_id = LoginController::getId();
        $bill->people_id = ($request->has('people_id') && $request->input('people_id') != 'other') ? $request->input('people_id') : NULL;
        $bill->debtor = ($request->input('people_id') == 'other') ? $request->input('debtor') : NULL;
        $bill->status = $request->input('status');
        $bill->title = $request->input('title');
        $bill->description = $request->input('description');
        $bill->amount = $request->input('amount');
        $bill->payday = $request->input('payday');
        $bill->billet = 'NULL';
        $bill->receipt = 'NULL';
        $bill->save();

        // Verify if Billet is Sended
        if($request->hasFile('billet')) {

            $billId = $bill->id;

            $file = $request->file('billet');

            $path = public_path("content/app/receivable_billets");

            $fileExtension = $file->getClientOriginalExtension();

            if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'])) {

                $fileName = 'billet-'. $billId .'-'. Str::uuid() .'.'. $fileExtension;

                $file->move($path, $fileName);

                $bill->billet = $fileName;

                $bill->save();

            }

        }

        // Verify if Receipt is Sended
        if($request->hasFile('receipt')) {

            $billId = $bill->id;

            $file = $request->file('receipt');

            $path = public_path("content/app/receivable_receipts");

            $fileExtension = $file->getClientOriginalExtension();

            if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'])) {

                $fileName = 'receipt-'. $billId .'-'. Str::uuid() .'.'. $fileExtension;

                $file->move($path, $fileName);

                $bill->receipt = $fileName;

                $bill->save();

            }

        }

        // Send Notify
        session()->flash('notifyType', 'success-add');

        // Log Action
        ClientsLogController::create('Criou Conta a Receber #' . $bill->id);

        // Control Return Method
        $return = \Helpers::destinationControl($return, $this->routePath, 'receivable_bill', $bill->id);

        // Return Redirect
        return redirect()->route($return['destination'], $return['parameters']);
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
    * @param  int  $receivable_bill
    * @return \Illuminate\Http\Response
    */
    public function edit($receivable_bill)
    {
        $bill = Bill::where('client_id', LoginController::getId())->where('id', $receivable_bill)->get()->first();

        $peopleList = $this->peopleList();

        return view($this->viewPath . 'edit', [ 'bill' => $bill, 'peopleList' => $peopleList ]);
    }

    /**
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $receivable_bill
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $receivable_bill)
    {
        // Execute Validation
        Validator::make($request->all(), $this->rules, $this->feedback)->validate();

        // Amount Format
        $request->merge([ 'amount' => \Main::moneySQL($request->input('amount')) ]);

        // Return Method
        $return = $request->input('_return');

        // Search Item
        $bill = Bill::where('client_id', LoginController::getId())->where('id', $receivable_bill)->get()->first();

        if(isset($bill->id)) {

            // Prepare Data
            $bill->people_id = ($request->has('people_id') && $request->input('people_id') != 'other') ? $request->input('people_id') : NULL;
            $bill->debtor = ($request->input('people_id') == 'other') ? $request->input('debtor') : NULL;
            $bill->status = $request->input('status');
            $bill->title = $request->input('title');
            $bill->description = $request->input('description');
            $bill->amount = $request->input('amount');
            $bill->payday = $request->input('payday');

            // Verify if Billet is Sended
            if($request->hasFile('billet')) {

                $billId = $receivable_bill;

                $file = $request->file('billet');

                $path = public_path("content/app/receivable_billets");

                $fileExtension = $file->getClientOriginalExtension();

                if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'])) {

                    // Delete Billet
                    if($bill->billet != '' && !is_null($bill->billet)) {

                        @unlink($path .'/'. $bill->billet);

                    }

                    $fileName = 'billet-'. $billId .'-'. Str::uuid() .'.'. $fileExtension;

                    $file->move($path, $fileName);

                    $bill->billet = $fileName;

                }

            }

            // Verify if Receipt is Sended
            if($request->hasFile('receipt')) {

                $billId = $receivable_bill;

                $file = $request->file('receipt');

                $path = public_path("content/app/receivable_receipts");

                $fileExtension = $file->getClientOriginalExtension();

                if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'])) {

                    // Delete Receipt
                    if($bill->receipt != '' && !is_null($bill->receipt)) {

                        @unlink($path .'/'. $bill->receipt);

                    }

                    $fileName = 'receipt-'. $billId .'-'. Str::uuid() .'.'. $fileExtension;

                    $file->move($path, $fileName);

                    $bill->receipt = $fileName;

                }

            }

            // Save
            $bill->save();

            // Send Notify
            session()->flash('notifyType', 'success-edit');

            // Log Action
            ClientsLogController::create('Editou Conta a Receber #' . $bill->id);

            // Control Return Method
            $return = \Helpers::destinationControl($return, $this->routePath, 'receivable_bill', $bill->id);

            // Return Redirect
            return redirect()->route($return['destination'], $return['parameters']);

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'error-edit');

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
    public function destroy($receivable_bill)
    {
        $bill = Bill::where('client_id', LoginController::getId())->where('id', $receivable_bill)->get()->first();

        if(isset($bill->id)) {

            // Delete Billet
            if($bill->billet != '' && !is_null($bill->billet)) {

                @unlink(public_path("content/app/receivable_billets") .'/'. $bill->billet);

            }

            // Delete Receipt
            if($bill->receipt != '' && !is_null($bill->receipt)) {

                @unlink(public_path("content/app/receivable_receipts") .'/'. $bill->receipt);

            }

            // Delete Item
            $bill->delete();

            // Send Notify
            session()->flash('notifyType', 'success-del');

            // Redirect
            return redirect()->route($this->routePath . 'index');

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'not-permited');

            // Redirect
            return redirect()->route($this->routePath . 'index');

        }
    }

    /**
     * search
    *
    * @param  mixed $request
    * @return void
    */
    public function search(Request $request)
    {

        if($request->filled('keywords') || $request->filled('payday')) {

            $privateRules = [];
            $privateFeedback = [];

            if($request->has('keywords') && $request->filled('keywords')) {

                // Validator Rules
                $privateRules['keywords'] = 'required|min:3|max:40';

                // Validator Feedback
                $privateFeedback['keywords.required'] = "Informe as palavras-chave para a busca.";

            }

            if($request->has('payday') && $request->filled('payday')) {

                // Validator Rules
                $privateRules['payday'] = 'required|min:10|max:10';

                // Validator Feedback
                $privateFeedback['payday.required'] = "Informe uma data válida para a busca.";

            }

            // Execute Validation
            Validator::make($request->all(), $privateRules, $privateFeedback)->validate();

            // Search Filters
            $kwd = $request->input('keywords');
            $payday = $request->input('payday');

            // Query
            $items = DB::table('receivable_bills')
            ->select(['receivable_bills.*', (DB::raw("COALESCE((SELECT p.name FROM people p WHERE p.id = receivable_bills.people_id), '-') AS people_name"))])
            ->where('client_id', LoginController::getId())
            ->where(function($query) use ($kwd, $payday) {

                // If Keywords is set
                if($kwd != '') {
                    $query->where('people_id', $kwd)
                    ->orWhere('title', 'LIKE', "%{$kwd}%")
                    ->orWhere('debtor', 'LIKE', "%{$kwd}%")
                    ->orWhere('people_name', 'LIKE', "%{$kwd}%");
                }

                // If Payday is set
                if($payday != '') {
                    $query->orWhere('payday', $payday);
                }

            })
            ->orderByDesc('payday')
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

    /**
     * peopleList
     *
     * @return void
     */
    private function peopleList() {

        return DB::table('people')
        ->select(['id', 'name'])
        ->where('client_id', LoginController::getId())
        ->orderByDesc('name')
        ->get();

    }

    /**
     * filterFields
     *
     * @param  mixed $request
     * @return void
     */
    public static function filterFields(Request $request)
    {

        return '<input type="'. ($request->filled('payday') ? 'date' : 'tel') .'" id="payday" name="payday" class="form-control align-center other-field" autocomplete="off" onfocus="(paydayFocus(this))" onblur="(paydayBlur(this))" placeholder="Data de Vencimento" value="'. ($request->filled('payday') ? $request->input('payday') : '') .'">';

    }
}
