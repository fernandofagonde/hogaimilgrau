
    @php

    // Module
    $module = 'receivable-bills';
    $route = 'app.'. $module;

    // Form Field Data
    $id = (isset($bill->id)) ? $bill->id : '';
    $status = (isset($bill->id)) ? $bill->status : old('status');
    $people_id = (isset($bill->id)) ? $bill->people_id : old('people_id');
    $debtor = (isset($bill->id)) ? $bill->debtor : old('debtor');
    $title = (isset($bill->id)) ? $bill->title : old('title');
    $description = (isset($bill->id)) ? $bill->description : old('description');
    $amount = (isset($bill->id)) ? $bill->amount : old('amount');
    $payday = (isset($bill->id)) ? $bill->payday : old('payday');

    $billet = (isset($bill->id)) ? $bill->billet : old('billet');
    $billet_file = $form_function == 'add' ? [] : ($bill->billet != '' ? [ $bill->billet ] : []);

    $receipt = (isset($bill->id)) ? $bill->receipt : old('receipt');
    $receipt_file = $form_function == 'add' ? [] : ($bill->receipt != '' ? [ $bill->receipt ] : []);

    // Form Params
    $params = ($id > 0) ? $id : '';

    // Form Route
    $route_verb = $form_function == 'add' ? 'store' : 'update';

    // Message
    if(session()->has('notifyType')) {
        echo Helpers::formAlert( session('notifyType') );
    }

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

    @endphp

    <div class="row">

        <div class="col-12 col-sm-6 col-md-4">

            @php

                /*
                * Status
                */

                $Items = [
                    [
                        'label' => 'Aberta',
                        'value' => 'OPEN',
                        'selected' => ($status == 'OPEN')
                    ],
                    [
                        'label' => 'Atrasada',
                        'value' => 'DELAYED',
                        'selected' => ($status == 'DELAYED')
                    ],
                    [
                        'label' => 'Paga',
                        'value' => 'PAID',
                        'selected' => ($status == 'PAID')
                    ],
                    [
                        'label' => 'Cancelada',
                        'value' => 'CANCELED',
                        'selected' => ($status == 'CANCELED')
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
                * Status Errors
                */

                if($errors->has('status')) {

                    echo Helpers::formError($errors->first('status'));

                }

            @endphp

        </div>

        <div class="col-12 col-sm-6 col-md-4">

            @php
                /*
                * People List
                */

                $Items = [
                    [
                        'label' => 'Selecione...',
                        'value' => '',
                        'selected' => ($people_id == '' || $form_function == 'add')
                    ],
                    [
                        'label' => 'Outro / Não Listado',
                        'value' => 'other',
                        'selected' => (is_null($people_id) && $form_function == 'edit')
                    ]
                ];

                if(sizeof($peopleList) > 0) {

                    foreach($peopleList AS $peopleItem) {

                        $Items[] = [
                            'label' => $peopleItem->name,
                            'value' => $peopleItem->id,
                            'selected' => ($people_id == $peopleItem->id)
                        ];

                    }

                }

                echo Html::formField(
                    'select',
                    [
                        'label' => 'Devedor',
                        'name' => 'people_id',
                        'class' => '',
                        'items' => $Items
                    ]
                );

                unset($Items);

                /*
                * People List Errors
                */

                if($errors->has('people_id')) {

                    echo Helpers::formError($errors->first('people_id'));

                }

            @endphp

        </div>

        <div class="col-12 col-sm-6 col-md-4">

            @php

                /*
                * Debtor
                */

                echo Html::formField(
                    'input',
                    [
                        'label' => 'Nome do Devedor',
                        'name' => 'debtor',
                        'value' => $debtor,
                        'class' => '',
                        'others' => ($form_function == 'add') ? ' disabled' : ''
                    ]
                );

                /*
                * Debtor Errors
                */

                if($errors->has('debtor')) {

                    echo Helpers::formError($errors->first('debtor'));

                }

            @endphp

        </div>

    </div>

    @php

        /*
        * Title
        */

        echo Html::formField(
            'input',
            [
                'label' => 'Título',
                'name' => 'title',
                'value' => $title,
                'class' => 'required'
            ]
        );

        /*
        * Title Errors
        */

        if($errors->has('title')) {

            echo Helpers::formError($errors->first('title'));

        }

        /*
        * Description
        */

        echo Html::formField(
            'textarea',
            [
                'label' => 'Descrição',
                'name' => 'description',
                'value' => $description,
                'editor' => false,
                'class' => '',
                'height' => 150
            ]
        );

        /*
        * Content Errors
        */

        if($errors->has('description')) {

            echo Helpers::formError($errors->first('description'));

        }

        /*
        * Form Divider
        */

        echo Html::divider();

    @endphp

    <div class="row">

        <div class="col-12 col-sm-6 col-md-4">

            @php
                /*
                * Amount
                */

                echo Html::formField(
                    'input-money',
                    [
                        'label' => 'Valor',
                        'name' => 'amount',
                        'value' => \Main::money($amount),
                        'class' => 'required masked',
                        'mask' => 'money'
                    ]
                );

                /*
                * Amount Errors
                */

                if($errors->has('amount')) {

                    echo Helpers::formError($errors->first('amount'));

                }
            @endphp

        </div>

        <div class="col-12 col-sm-6 col-md-4">

            @php
                /*
                * Payday
                */

                echo Html::formField(
                    'input',
                    [
                        'type' => 'date',
                        'label' => 'Vencimento',
                        'name' => 'payday',
                        'value' => $payday,
                        'class' => 'required align-center'
                    ]
                );

                /*
                * Payday Errors
                */

                if($errors->has('payday')) {

                    echo Helpers::formError($errors->first('payday'));

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
        * Billet Uploader
        */

        echo Html::uploadField([
            'label' => 'Boleto / NF-e',
            'name' => 'billet',
            'route' => $route,
            'limit-files' => 1,
            'limit-size' => 5,
            'extensions' => '.pdf,.jpg,.jpeg,.png,.webp,.gif',
            'placeholder' => 'Selecione o arquivo para envio.<br>Formatos aceitos PDF, JPG, GIF, PNG ou WEBP'
        ]);

        /*
        * List Files
        */
        if(sizeof($billet_file) > 0 && $billet_file[0] != '' && $billet_file[0] != 'NULL') {

            $extension = Main::extension($billet_file[0]);

            echo '<div class="list-files">
                <div class="list-row">
                    <div class="row">
                        <div class="col-8">'. Html::icon('icon-paperclip color-primary') .' '. $billet_file[0] .'</div>
                        <div class="col-4 align-right">
                            <a href="'. url('content/app/receivable_billets') .'/'. $billet_file[0] .'" class="button button-primary button-inline button-small" download>'. Html::icon('icon-download') .'</a>
                            <button type="button" class="button button-danger button-inline button-small button-delete-attachment" data-module="'. $module .'" data-field="billet" data-id="'. $id .'">'. Html::icon('icon-trash') .'</a>
                        </div>
                    </div>
                </div>
            </div>';

            unset($extension);

        }

        /*
        * Form Divider
        */

        echo Html::divider();

        /*
        * Receipt Uploader
        */

        echo Html::uploadField([
            'label' => 'Comprovante',
            'name' => 'receipt',
            'route' => $route,
            'limit-files' => 1,
            'limit-size' => 5,
            'extensions' => '.pdf,.jpg,.jpeg,.png,.webp,.gif',
            'placeholder' => 'Selecione o arquivo para envio.<br>Formatos aceitos PDF, JPG, GIF, PNG ou WEBP'
        ]);

        /*
        * List Files
        */
        if(sizeof($receipt_file) > 0 && $receipt_file[0] != '' && $receipt_file[0] != 'NULL') {

            $extension = Main::extension($receipt_file[0]);

            echo '<div class="list-files">
                <div class="list-row">
                    <div class="row">
                        <div class="col-8">'. Html::icon('icon-paperclip color-primary') .' '. $receipt_file[0] .'</div>
                        <div class="col-4 align-right">
                            <a href="'. url('content/app/receivable_receipts') .'/'. $receipt_file[0] .'" class="button button-primary button-small button-inline" download>'. Html::icon('icon-download') .'</a>
                            <button type="button" class="button button-danger button-inline button-small button-delete-attachment" data-module="'. $module .'" data-field="receipt" data-id="'. $id .'">'. Html::icon('icon-trash') .'</a>
                        </div>
                    </div>
                </div>
            </div>';

            unset($extension);

        }

    @endphp

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

<form id="delete-form" action="" method="post">
    @method('DELETE')
    @csrf
    <input type="hidden" name="field" id="field" value="">
</form>
