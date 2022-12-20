@php

    // Module
    $module = 'payable-bills';
    $route = 'app.'. $module;

    // Messages
    $messages = [
        'emptyList' => [
            'title' => 'Nada a mostrar!',
            'message' => 'Nenhuma conta à pagar foi cadastrada até o momento.'
        ]
    ];

@endphp

@extends('app.templates.basic')

@section('title', 'Contas à Pagar | Listando')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('app._components.list-header', [
                'module' => $module,
                'route' => $route,
                'form_function' => $form_function ?? [],
                'request' => request(),
                'placeholder' => 'Busque pelo título ou descrição...',
                'otherFields' => \App\Http\Controllers\App\PayableBillsController::filterFields(request())
            ])
            @endcomponent

            @if(count($items) > 0)

                <div id="module-list" class="active">

                    @component('app.payable_bills.components.list', [ 'module' => $module, 'route' => $route, 'items' => $items ])
                    @endcomponent

                </div>

            @else

                <div id="module-list-empty">
                    @php

                        echo '<h1>'. $messages['emptyList']['title'] .'</h1>
                        <h2>'. $messages['emptyList']['message'] .'</h2>';

                    @endphp
                </div>

            @endif

        </div>

    </section>

@endsection

@section('js')
    <script src="/assets/js/app/modules/payable_bills.js"></script>
@endsection

