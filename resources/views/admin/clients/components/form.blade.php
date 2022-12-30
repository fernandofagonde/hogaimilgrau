
    @php

        // Module
        $module = 'clients';
        $route = 'admin.'. $module;

        // Form Field Data
        $id = (isset($people->id)) ? $people->id : '';
        $status = (isset($people->id)) ? $people->status : old('status');
        $name = (isset($people->id)) ? $people->name : old('name');
        $document_type = (isset($people->id)) ? $people->document_type : old('document_type');
        $document = (isset($people->id)) ? $people->document : old('document');
        $phone = (isset($people->id)) ? $people->phone : old('phone');
        $phone_whatsapp = (isset($people->id)) ? $people->phone_whatsapp : old('phone_whatsapp');
        $city = (isset($people->id)) ? $people->city : old('city');
        $uf = (isset($people->id)) ? $people->uf : old('uf');
        $email = (isset($people->id)) ? $people->email : old('email');

        // Form Params
        $params = ($id > 0) ? $id : '';

        // Form Route
        $route_verb = $form_function == 'add' ? 'store' : 'update';

        // Open Form
        echo Html::formOpen(route($route . '.' . $route_verb, $params), $form_function);

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
                'label' => 'Inativo',
                'value' => 'INACTIVE',
                'selected' => ($status == 'INACTIVE')
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

        <div class="col-12 col-sm-12 col-lg-6">
            @php

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

                foreach($ufs AS $uf) {

                    $Items[] = [
                        'label' => $uf,
                        'value' => $uf,
                        'selected' => ($uf == $uf)
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

        <div class="col-12 col-sm-4">

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
