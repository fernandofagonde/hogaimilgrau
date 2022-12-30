
    @php

        // Module
        $module = 'clients';
        $route = 'admin.'. $module;

        // Form Field Data
        $id = (isset($client->id)) ? $client->id : '';
        $status = (isset($client->id)) ? $client->status : old('status');
        $name = (isset($client->id)) ? $client->name : old('name');
        $document_type = (isset($client->id)) ? $client->document_type : old('document_type');
        $document = (isset($client->id)) ? $client->document : old('document');
        $phone = (isset($client->id)) ? $client->phone : old('phone');
        $phone_whatsapp = (isset($client->id)) ? $client->phone_whatsapp : old('phone_whatsapp');
        $city = (isset($client->id)) ? $client->city : old('city');
        $uf = (isset($client->id)) ? $client->uf : old('uf');
        $email = (isset($client->id)) ? $client->email : old('email');

        $image_file = ($client->image != '') ? [ $client->image ] : [];

        // Form Params
        $params = ($id > 0) ? $id : '';

        // Form Route
        $route_verb = $form_function == 'add' ? 'store' : 'update';

        // Open Form
        echo Html::formOpen(route($route . '.' . $route_verb, $params), $form_function, true);

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
        * Type
        */

        $Items = [
            [
                'label' => 'Ativo',
                'value' => 'ACTIVE',
                'selected' => ($status == 'ACTIVE')
            ],
            [
                'label' => 'Bloqueado',
                'value' => 'BLOCKED',
                'selected' => ($status == 'BLOCKED')
            ]
        ];

        echo Html::formField(
            'select',
            [
                'label' => 'Status',
                'name' => 'status',
                'class' => 'required',
                'items' => $Items
            ]
        );

        unset($Items);

        /*
        * Type Errors
        */

        if($errors->has('status')) {

            echo Helpers::formError($errors->first('status'));

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

    @endphp

    <div class="row">

        <div class="col-12 col-sm-4 col-md-3">
            @php

            $Items = [
                [
                    'label' => 'CPF',
                    'value' => 'CPF',
                    'selected' => ($document_type == 'CPF')
                ],
                [
                    'label' => 'CNPJ',
                    'value' => 'CNPJ',
                    'selected' => ($document_type == 'CNPJ')
                ]
            ];


            echo Html::formField(
                'select',
                [
                    'label' => 'Tipo de Documento',
                    'name' => 'document_type',
                    'class' => 'required',
                    'items' => $Items
                ]
            );

            unset($Items);

            /*
            * Type Errors
            */

            if($errors->has('document_type')) {

                echo Helpers::formError($errors->first('document_type'));

            }

            @endphp
        </div>

        <div class="col-12 col-sm-8 col-md-5 col-lg-4">
            @php

            /*
            * Document
            */

            echo Html::formField(
                'input',
                [
                    'label' => 'Documento',
                    'name' => 'document',
                    'value' => $document,
                    'class' => 'required masked align-center',
                    'mask' => 'cpf'
                ]
            );

            /*
            * Document Errors
            */

            if($errors->has('document')) {

                echo Helpers::formError($errors->first('document'));

            }

            @endphp
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-sm-8 col-md-4">
            @php

            /*
            * Phone
            */

            echo Html::formField(
                'input',
                [
                    'label' => 'Telefone',
                    'name' => 'phone',
                    'value' => $phone,
                    'class' => 'required masked align-center',
                    'mask' => 'phone'
                ]
            );

            /*
            * Phone Errors
            */

            if($errors->has('phone')) {

                echo Helpers::formError($errors->first('phone'));

            }

            @endphp
        </div>

        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
            @php

            /*
            * Phone WhatsApp
            */

            $Items = [
                [
                    'label' => 'Sim',
                    'value' => 'Y',
                    'selected' => ($phone_whatsapp == 'Y')
                ],
                [
                    'label' => 'Não',
                    'value' => 'N',
                    'selected' => ($phone_whatsapp == 'N')
                ]
            ];


            echo Html::formField(
                'select',
                [
                    'label' => 'WhatsApp?',
                    'name' => 'phone_whatsapp',
                    'class' => 'required',
                    'items' => $Items
                ]
            );

            unset($Items);

            /*
            * Phone WhatsApp Errors
            */

            if($errors->has('phone_whatsapp')) {

                echo Helpers::formError($errors->first('phone_whatsapp'));

            }

            @endphp
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-sm-8">
            @php
                /*
                * City
                */

                echo Html::formField(
                    'input',
                    [
                        'label' => 'Cidade',
                        'name' => 'city',
                        'value' => $city,
                        'class' => 'required'
                    ]
                );

                /*
                * City Errors
                */

                if($errors->has('city')) {

                    echo Helpers::formError($errors->first('city'));

                }
            @endphp
        </div>

        <div class="col-12 col-sm-4">
            @php

                /*
                * State
                */

                $ufs = Main::UF();

                $items = [];

                foreach($ufs AS $_uf) {

                    $Items[] = [
                        'label' => $_uf,
                        'value' => $_uf,
                        'selected' => ($_uf == $uf)
                    ];

                }

                echo Html::formField(
                    'select',
                    [
                        'label' => 'Estado',
                        'name' => 'uf',
                        'class' => 'required',
                        'items' => $Items
                    ]
                );

                unset($Items);

                /*
                * State Errors
                */

                if($errors->has('uf')) {

                    echo Helpers::formError($errors->first('uf'));

                }

            @endphp
        </div>

    </div>

    @php

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
                        <div class="embed-responsive embed-responsive-4by3" style="--bg-image: url('. url('content/app/profile') .'/thumb/'. $client->image .');">
                            <a class="glightbox-item" data-href="'. url('content/app/profile') .'/large/'. $client->image .'"></a>
                        </div>
                        <div class="image-list-buttons">
                            <button type="button" class="button button-danger button-icon button-delete-attachment" data-module="'. $module .'" data-field="image" data-id="'. $client->id .'">'. Html::icon('icon-trash') .' APAGAR</button>
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

        /*
        * E-mail
        */

        echo Html::formField(
            'input',
            [
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

        /*
        * Password Edit Alert
        */
        if($form_function == 'edit') {
            echo Helpers::formAlert('custom', '', [ 'info', 'icon-alert', 'Preencha o campo Password apenas se desejar alterar o password atual do cliente.' ]);
        }

    @endphp

    <div class="row">

        <div class="col-12 col-sm-6 col-lg-3">
            @php
                /*
                * Password
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'password',
                        'label' => 'Password',
                        'name' => 'password',
                        'value' => '',
                        'class' => ($form_function == 'add') ? 'required' : '',
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

        <div class="col-12 col-sm-6 col-lg-3">
            @php
                /*
                * Retype Password
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'password',
                        'label' => 'Repita o Password',
                        'name' => 'retype_password',
                        'value' => '',
                        'class' => ($form_function == 'add') ? 'required' : '',
                        'max' => 12
                    ]
                );

                /*
                * New Password Errors
                */

                if($errors->has('retype_password')) {

                    echo Helpers::formError($errors->first('retype_password'));

                }
            @endphp
        </div>

    </div>

    <div id="form-buttons">
        @php

        /*
        * Buttons
        */

        echo Html::formButtons($id, $module, (($form_function == 'add') ? 'save-add' : 'save-edit'));

        /*
        * Close Form
        */
        echo Html::formClose();

        @endphp
    </div>

</form>
