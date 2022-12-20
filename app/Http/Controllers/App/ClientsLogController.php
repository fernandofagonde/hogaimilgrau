<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\App\LoginController;

use App\Models\ClientsLog;

class ClientsLogController extends Controller
{
    public static function create( $logMessage )
    {
        $log = new ClientsLog;
        $log->client_id = LoginController::getId();
        $log->message = $logMessage;
        $log->save();

    }
}
