<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LoginController;

use App\Models\Client;

class AdminController extends Controller
{

    public function index(Request $request) {

        $stats = DB::table('clients')
        ->selectRaw(DB::raw("COALESCE((SELECT COUNT(id) FROM clients), 0) AS totalClients"))
        ->selectRaw(DB::raw("COALESCE((SELECT COUNT(id) FROM clients WHERE status = 'ACTIVE'), 0) AS activeClients"))
        ->selectRaw(DB::raw("COALESCE((SELECT COUNT(id) FROM clients_logins), 0) AS loggedClients"))
        ->get()
        ->first();

        if(!isset($stats->totalClients)) {

            $stats =(object) [
                'totalClients' => 0,
                'activeClients' => 0,
                'loggedClients' => 0
            ];

        }

        return view('admin.index', compact(['stats']));

    }

}
