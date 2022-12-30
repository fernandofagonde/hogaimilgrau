
    @php

    // Module
    $module = 'profile';
    $route = 'admin.'. $module;

    // Form Field Data
    $name = (isset($profile->id)) ? $profile->name : old('name');
    $email = (isset($profile->id)) ? $profile->email : old('email');

    $image_file = ($profile->image != '') ? [ $profile->image ] : [];

    // Form Route
    $route_verb = 'update';

    // Open Form
    echo Html::formOpen(route($route . '.' . $route_verb), 'edit', true);

    @endphp

    @csrf

    @php


        /*
        * Errors
        */

        if($errors->any()) {

            echo Html::alert('danger', Html::icon('icon-times') . ' Verifique os erros e tente novamente.');

        }

        /*
        * Name
        */

        echo Html::formField(
            'input',
            [
                'label' => 'Nome',
                'name' => 'name',
                'value' => $name,
                'class' => 'required'
            ]
        );

        /*
        * Name Errors
        */

        if($errors->has('name')) {

            echo Helpers::formError($errors->first('name'));

        }

        /*
        * Form Divider
        */

        echo Html::divider();

        /*
        * Profile Image Uploader
        */

        echo Html::uploadField([
            'label' => 'Imagem de Perfil',
            'name' => 'image',
            'route' => $route,
            'limit-files' => 1,
            'limit-size' => 5,
            'placeholder' => 'Selecione o arquivo para envio.<br>Formatos aceitos JPG, GIF, PNG ou WEBP'
        ]);

        /*
        * List Files
        */

        if(sizeof($image_file) > 0 && $image_file[0] != '' && $image_file[0] != 'NULL') {

            $extension = Main::extension($image_file[0]);

            echo '<div class="image-list">
                <div class="image-list-item">
                    <div class="image-list-item-box glightbox" data-selector="a.glightbox-item">
                        <div class="embed-responsive embed-responsive-4by3" style="--bg-image: url('. url('content/admin/profile') .'/thumb/'. $profile->image .');">
                            <a class="glightbox-item" data-href="'. url('content/admin/profile') .'/large/'. $profile->image .'"></a>
                        </div>
                        <div class="image-list-buttons">
                            <button type="button" class="button button-danger button-icon button-delete-attachment" data-module="'. $module .'" data-field="image" data-id="'. $profile->id .'">'. Html::icon('icon-trash') .' APAGAR</button>
                        </div>
                    </div>
                </div>
            </div>';

            unset($extension);

        }

        /*
        * Divider
        */

        echo Html::divider();

    @endphp

    <div class="row">

        <div class="col-12 col-md-8 col-lg-6">
            @php
                /*
                * E-mail
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'email',
                        'label' => 'E-mail',
                        'name' => 'email',
                        'value' => $email,
                        'class' => 'required'
                    ]
                );

                /*
                * E-mail Errors
                */

                if($errors->has('email')) {

                    echo Helpers::formError($errors->first('email'));

                }
            @endphp
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            @php
                /*
                * Password
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'password',
                        'label' => 'Password Atual',
                        'name' => 'password',
                        'value' => '',
                        'class' => 'required',
                        'max' => 12
                    ]
                );

                /*
                * Password Errors
                */

                if($errors->has('password')) {

                    echo Helpers::formError($errors->first('password'));

                }
            @endphp
        </div>

    </div>

    @php

        echo Html::divider();

    @endphp

    <div class="row">

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            @php
                /*
                * New Password
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'password',
                        'label' => 'Novo Password',
                        'name' => 'new_password',
                        'value' => '',
                        'class' => '',
                        'max' => 12
                    ]
                );

                /*
                * New Password Errors
                */

                if($errors->has('new_password')) {

                    echo Helpers::formError($errors->first('new_password'));

                }
            @endphp
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            @php
                /*
                * Retype New Password
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'password',
                        'label' => 'Repita o Novo Password',
                        'name' => 'retype_new_password',
                        'value' => '',
                        'class' => '',
                        'max' => 12
                    ]
                );

                /*
                * New Password Errors
                */

                if($errors->has('retype_new_password')) {

                    echo Helpers::formError($errors->first('retype_new_password'));

                }
            @endphp
        </div>

    </div>

    <div id="form-buttons">
        @php

        /*
        * Buttons
        */

        echo Html::formButtons(0, $module, 'save-config');

        /*
        * Close Form
        */
        echo Html::formClose();

        @endphp
    </div>

</form>

<form id="delete-form" action="" method="post">
    @method('DELETE')
    @csrf
    <input type="hidden" name="field" id="field" value="">
</form>
