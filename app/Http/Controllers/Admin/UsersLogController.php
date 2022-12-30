<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\LoginController;

use App\Models\UsersLog;

class UsersLogController extends Controller
{
    public static function create( $logMessage )
    {
        $log = new UsersLog;
        $log->user_id = LoginController::getId();
        $log->message = $logMessage;
        $log->save();

    }
}
