<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helpers;
use App\Http\Middleware\CountVisitMiddleware;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\SendEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [\App\Http\Controllers\Site\HomeController::class, 'index'])->name('site.home');

/*
|--------------------------------------------------------------------------
| App Login Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/signin', [\App\Http\Controllers\App\LoginController::class, 'index'])->name('site.signin');
Route::post('/signin', [\App\Http\Controllers\App\LoginController::class, 'autenticate'])->name('site.signin');
Route::post('/recovery', [\App\Http\Controllers\App\ClientsController::class, 'recovery'])->name('site.recovery');
//Route::get('/signup', [\App\Http\Controllers\App\ClientsController::class, 'index'])->name('site.signup');
//Route::post('/signup', [\App\Http\Controllers\App\CLientsController::class, 'create'])->name('site.signup');

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('app')->middleware('app.auth')->group(function() {

    Route::name('app.')->group(function() {

        // People
        Route::post('people/search', [\App\Http\Controllers\App\PeopleController::class, 'search'])->name('people.search');
        Route::get('people/search', [\App\Http\Controllers\App\PeopleController::class, 'search'])->name('people.search');
        Route::resource('people', \App\Http\Controllers\App\PeopleController::class);

        // Bills to Receive
        Route::delete('receivable-bills/attachment/{receivable_bill}', [\App\Http\Controllers\App\ReceivableBillsController::class, 'deleteAttachment'])->name('receivable-bills.attachment_delete');
        Route::put('receivable-bills/status', [\App\Http\Controllers\App\ReceivableBillsController::class, 'status'])->name('receivable-bills.status');
        Route::post('receivable-bills/search', [\App\Http\Controllers\App\ReceivableBillsController::class, 'search'])->name('receivable-bills.search');
        Route::get('receivable-bills/search', [\App\Http\Controllers\App\ReceivableBillsController::class, 'search'])->name('receivable-bills.search');
        Route::resource('receivable-bills', \App\Http\Controllers\App\ReceivableBillsController::class);

        // Payable Bills
        Route::delete('payable-bills/attachment/{payable_bill}', [\App\Http\Controllers\App\PayableBillsController::class, 'deleteAttachment'])->name('payable-bills.attachment_delete');
        Route::put('payable-bills/status', [\App\Http\Controllers\App\PayableBillsController::class, 'status'])->name('payable-bills.status');
        Route::post('payable-bills/search', [\App\Http\Controllers\App\PayableBillsController::class, 'search'])->name('payable-bills.search');
        Route::get('payable-bills/search', [\App\Http\Controllers\App\PayableBillsController::class, 'search'])->name('payable-bills.search');
        Route::resource('payable-bills', \App\Http\Controllers\App\PayableBillsController::class);

        // Profile
        Route::get('profile', [\App\Http\Controllers\App\ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile/update', [\App\Http\Controllers\App\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/attachment/{profile}', [\App\Http\Controllers\App\ProfileController::class, 'deleteAttachment'])->name('profile.attachment_delete');

    });

    // Logout
    Route::get('/logout', [\App\Http\Controllers\App\LoginController::class, 'logout'])->name('app.logout');

    // Dashboard
    Route::get('/', [\App\Http\Controllers\App\AppController::class, 'index'])->name('app.index');

    //Route::post('/uploads', 'UploadController@upload')->name('upload');

});

/*
|--------------------------------------------------------------------------
| Admin Login Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'autenticate'])->name('site.login');
Route::post('/login-recovery', [\App\Http\Controllers\Admin\UsersController::class, 'recovery'])->name('site.login.recovery');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->middleware('admin.auth')->group(function() {

    Route::name('admin.')->group(function() {

        // Clients
        Route::delete('clients/attachment/{client}', [\App\Http\Controllers\App\ReceivableBillsController::class, 'deleteAttachment'])->name('clients.attachment_delete');
        Route::put('clients/status', [\App\Http\Controllers\App\ReceivableBillsController::class, 'status'])->name('clients.status');
        Route::post('clients/search', [\App\Http\Controllers\App\ReceivableBillsController::class, 'search'])->name('clients.search');
        Route::get('clients/search', [\App\Http\Controllers\App\ReceivableBillsController::class, 'search'])->name('clients.search');
        Route::resource('clients', \App\Http\Controllers\App\ReceivableBillsController::class);

        // Profile
        Route::get('profile', [\App\Http\Controllers\App\ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile/update', [\App\Http\Controllers\App\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/attachment/{profile}', [\App\Http\Controllers\App\ProfileController::class, 'deleteAttachment'])->name('profile.attachment_delete');

    });

    // Logout
    Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

    // Dashboard
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');


});
