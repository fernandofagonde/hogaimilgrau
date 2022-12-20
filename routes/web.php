<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helpers;
use App\Http\Middleware\CountVisitMiddleware;
use App\Http\Controllers\NotifyController;

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

//withoutMiddleware
Route::get('/signin', [\App\Http\Controllers\App\LoginController::class, 'index'])->name('site.signin');
Route::post('/signin', [\App\Http\Controllers\App\LoginController::class, 'autenticate'])->name('site.signin');
Route::post('/remember', [\App\Http\Controllers\App\ClientsController::class, 'remember'])->name('site.remember');
Route::get('/signup', [\App\Http\Controllers\App\ClientsController::class, 'index'])->name('site.signup');
Route::post('/signup', [\App\Http\Controllers\App\CLientsController::class, 'create'])->name('site.signup');


//withoutMiddleware
Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'autenticate'])->name('site.login');

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

    });

    // Logout
    Route::get('/logout', [\App\Http\Controllers\App\LoginController::class, 'logout'])->name('app.logout');

    // Dashboard
    Route::get('/', [\App\Http\Controllers\App\AppController::class, 'index'])->name('app.index');

    //Route::post('/uploads', 'UploadController@upload')->name('upload');

});

// Route::prefix('admin')->middleware('admin.auth')->group(function() {

//     $AdminRoutes = [
//         'blog-categories',
//         'blog-posts',
//         'users'
//     ];

//     Route::get('/users', function() { return 'Usuários'; })->name('usuarios');


//     // Route::get('/blog-categories/add', [\App\Http\Controllers\Admin\BlogCategoriesController::class, 'add'])->name('admin.blog.categories.add');
//     // Route::get('/blog-categories/edit/{id?}', [\App\Http\Controllers\Admin\BlogCategoriesController::class, 'edit'])->name('admin.blog.categories.edit');

//     // Route::post('/blog-categories/save', [\App\Http\Controllers\Admin\BlogCategoriesController::class, 'save'])->name('admin.blog.categories.save');

//     // Route::get('/blog-categories/del/{id?}', [\App\Http\Controllers\Admin\BlogCategoriesController::class, 'del'])->name('admin.blog.categories.del');
//     // Route::get('/blog-categories', [\App\Http\Controllers\Admin\BlogCategoriesController::class, 'index'])->name('admin.blog.categories');

//     // Route::get('/blog-posts/add', [\App\Http\Controllers\Admin\BlogPostsController::class, 'add'])->name('admin.blog.posts.add');
//     // Route::get('/blog-posts/edit/{id?}', [\App\Http\Controllers\Admin\BlogPostsController::class, 'edit'])->name('admin.blog.posts.edit');
//     // Route::get('/blog-posts/del/{id?}', [\App\Http\Controllers\Admin\BlogPostsController::class, 'del'])->name('admin.blog.posts.del');
//     // Route::post('/blog-posts/save', [\App\Http\Controllers\Admin\BlogPostsController::class, 'save'])->name('admin.blog.posts.save');
//     // Route::post('/blog-posts/search', [\App\Http\Controllers\Admin\BlogPostsController::class, 'search'])->name('admin.blog.posts.search');
//     // Route::get('/blog-posts', [\App\Http\Controllers\Admin\BlogPostsController::class, 'index'])->name('admin.blog.posts');

//     Route::name('admin.')->group(function() {

//         // Blog Categories
//         Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoriesController::class);

//         // Blog Posts
//         Route::put('blog-posts/status', [\App\Http\Controllers\Admin\BlogPostsController::class, 'status'])->name('blog-posts.status');
//         Route::post('blog-posts/search', [\App\Http\Controllers\Admin\BlogPostsController::class, 'search'])->name('blog-posts.search');
//         Route::get('blog-posts/search', [\App\Http\Controllers\Admin\BlogPostsController::class, 'search'])->name('blog-posts.search');
//         Route::resource('blog-posts', \App\Http\Controllers\Admin\BlogPostsController::class);

//         // Support
//         Route::resource('support-email', \App\Http\Controllers\Admin\SupportEmailController::class);
//         Route::resource('support-whatsapp', \App\Http\Controllers\Admin\SupportWhatsappController::class);

//         // Profile
//         Route::resource('profile', \App\Http\Controllers\Admin\ProfileController::class);

//     });

//     // Logout
//     Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

//     // Dashboard
//     Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

//     //Route::post('/uploads', 'UploadController@upload')->name('upload');

// });

// // Fallback
// Route::fallback(function() {

//     return 'Página não encontrada, volte para a <a href="'. route('site.home') .'">página inicial</a> do site.';

// });
