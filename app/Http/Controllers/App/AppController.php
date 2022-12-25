<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\App\LoginController;

class AppController extends Controller
{

    public function index(Request $request) {

        $clientId = LoginController::getId();

        // People
        $people = DB::table('people')
        ->select(['id'])
        ->where('client_id', $clientId)
        ->get()->all();

        // Payable
        $payable = DB::table('payable_bills')
        ->select([
            'payable_bills.*',
            (DB::raw("COALESCE((SELECT p.name FROM people p WHERE p.id = payable_bills.people_id), '-') AS people_name"))
        ])
        ->where('payable_bills.client_id', $clientId)
        ->whereDate('payable_bills.payday', '>=', date('Y-m-d'))
        ->orderBy('payable_bills.payday')
        ->get()->all();

        // Payable Provided
        $payableProvided = DB::table('payable_bills')
        ->select([
            (DB::raw("SUM(amount) AS total"))
        ])
        ->where('client_id', $clientId)
        ->whereDate('payday', '>=', date('Y-m-d'))
        ->get()->all();

        // Receivable
        $receivable = DB::table('receivable_bills')
        ->select([
            'receivable_bills.*',
            (DB::raw("COALESCE((SELECT p.name FROM people p WHERE p.id = receivable_bills.people_id), '-') AS people_name"))
        ])
        ->where('receivable_bills.client_id', $clientId)
        ->whereDate('receivable_bills.payday', '>=', date('Y-m-d'))
        ->orderBy('receivable_bills.payday')
        ->get()->all();

        // Receivable Provided
        $receivableProvided = DB::table('receivable_bills')
        ->select([
            (DB::raw("SUM(amount) AS total"))
        ])
        ->where('client_id', $clientId)
        ->whereDate('payday', '>=', date('Y-m-d'))
        ->get()->all();

        // Total Provided
        $totalProvided = DB::select("SELECT
            (
                COALESCE((SELECT SUM(amount) FROM receivable_bills WHERE client_id = '". $clientId ."' AND status <> 'CANCELED'), 0) -
                COALESCE((SELECT SUM(amount) FROM payable_bills WHERE client_id = '". $clientId ."' AND status <> 'CANCELED'), 0)
            ) AS total
        ");

        $stats = [
            'people' => sizeof($people),
            'payable' => sizeof($payable),
            'receivable' => sizeof($receivable),
            'payableProvided' => isset($payableProvided[0]->total) ? $payableProvided[0]->total * 1 : 0.00,
            'receivableProvided' => isset($receivableProvided[0]->total) ? $receivableProvided[0]->total * 1 : 0.00,
            'totalProvided' => isset($totalProvided[0]->total) ? $totalProvided[0]->total * 1 : 0.00
        ];

        return view('app.index', compact(['stats', 'payable', 'receivable']));

    }

}
