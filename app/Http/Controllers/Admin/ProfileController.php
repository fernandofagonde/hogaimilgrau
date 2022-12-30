<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UsersLogController;

use App\Models\User;

class ProfileController extends Controller
{

    /**
     * Common Vars
     */

    var $routePath = 'admin.profile.';
    var $viewPath = 'admin.profile.';

    /**
     * Validator Rules
    */

    var $rules = [
        'name' => 'required|min:5|max:190',
        'email' => 'required|email|unique:clients',
        'password' => 'required|min:6|max:12',
    ];

    /**
     * Validator Feedback
    */

    var $feedback = [
        'name.required' => "O campo Nome é obrigatório.",
        'email.required' => "O campo E-mail é obrigatório.",
        'email.email' => "O e-mail informado é inválido.",
        'email.unique' => "O e-mail informado já está em uso.",
        'password.required' => "O campo Password Atual é obrigatório.",
        'password.min' => "O campo Password Atual deve conter entre 6 e 12 caracteres.",
        'password.max' => "O campo Password Atual deve conter entre 6 e 12 caracteres.",
        'new_password.min' => "O campo Novo Password deve conter entre 6 e 12 caracteres.",
        'new_password.max' => "O campo Novo Password deve conter entre 6 e 12 caracteres.",
        'new_password.same' => "O campo Novo Password e Repita o Novo Password não correspondem.",
        'retype_new_password.min' => "O campo Repita o Novo Password deve conter entre 6 e 12 caracteres.",
        'retype_new_password.max' => "O campo Repita o Novo Password deve conter entre 6 e 12 caracteres.",
        'retype_new_password.same' => "O campo Password e Repita o Novo Password não correspondem."
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = DB::table('users')
            ->select(['id', 'name', 'image', 'email'])
            ->where('id', LoginController::getId())
            ->get()->first();

        return view('admin.profile.index', [ 'profile' => $profile ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Client ID
        $userId = LoginController::getId();

        // Update Validation Rules
        $rules = $this->rules;
        $rules['email'] .= ',email,'. $userId;

        if(strlen($request->input('new_password')) > 0) {

            $rules['new_password'] = 'min:6|max:12|same:retype_new_password';
            $rules['retype_new_password'] = 'min:6|max:12|same:new_password';

        }

        // Execute Validation
        Validator::make($request->all(), $rules, $this->feedback)->validate();

        $profile = User::where('id', $userId)->get()->first();

        if(Hash::check($request->input('password'), $profile->password)) {

            $profile->name = $request->input('name');
            $profile->email = $request->input('email');

            if(strlen($request->input('new_password')) >= 6 &&  strlen($request->input('new_password')) <= 12 && $request->input('new_password') === $request->input('retype_new_password')) {

                $profile->password = Hash::make($request->input('new_password'));

            }

            if($request->hasFile('image')) {

                $profileId = $profile->id;

                $file = $request->file('image');

                $path = public_path("content/admin/profile");

                $fileExtension = $file->getClientOriginalExtension();

                if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {

                    // Delete Billet
                    if($profile->image != '' && !is_null($profile->image)) {

                        @unlink($path .'/'. $profile->image);

                    }

                    $fileName = 'profile-'. $profileId .'-'. Str::uuid() .'.webp';

                    $file->move(public_path('content/temp'), $file->getClientOriginalName());
                    $tempfile = public_path('content/temp') .'/'. $file->getClientOriginalName();

                    $profile->image = $fileName;
                    $profile->save();

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

            $profile->save();

            // Send Notify
            session()->flash('notifyType', 'success-edit');

            // Log Action
            UsersLogController::create('Alterou Profile');

            // Return Redirect
            return redirect()->route($this->routePath . 'index');

        }
        else {

            // Return Redirect
            return redirect()->route($this->routePath . 'index')->withErrors(['password' => 'O password atual está incorreto.']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }


    /**
     * attachment_delete
     *
     * @param  mixed $request
     * @param  mixed $profile
     * @return void
     */
    public function deleteAttachment(Request $request, $discard) {

        $profile = User::select(['id', 'image'])
            ->where('id', LoginController::getId())
            ->get()->first();

        if(isset($profile->id)) {

            // Delete Billet
            if($request->input('field') == 'image') {

                if($profile->image != '' && !is_null($profile->image)) {

                    @unlink(public_path("content/admin/profile") .'/thumb/'. $profile->image);
                    @unlink(public_path("content/admin/profile") .'/large/'. $profile->image);

                }

                $profile->image = '';

            }

            // Save
            $profile->save();

            // Send Notify
            session()->flash('notifyType', 'success-del-attachment');

            return redirect()->route($this->routePath . 'index', [ 'profile' => $profile ]);

        }
        else {

            // Send Notify
            session()->flash('notifyType', 'not-permited');

            return redirect()->route($this->routePath . 'index');

        }

    }

}
