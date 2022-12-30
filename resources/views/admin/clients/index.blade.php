@php

    // Module
    $module = 'clients';
    $route = 'admin.'. $module;

    // Messages
    $messages = [
        'emptyList' => [
            'title' => 'Nada a mostrar!',
            'message' => 'Nenhuma pessoa foi cadastrada até o momento.'
        ]
    ];

@endphp

@extends('admin.templates.basic')

@section('title', 'Clientes | Listando')

@section('body')

    <section class="section">

        <div class="section-body">

            @php
                echo Helpers::moduleBar($route, true, ((isset($kwd)) ? $kwd : ''), 'Busque pelo nome ou e-mail...');
            @endphp

            @if(isset($form_function) && isset($form_function->type) && isset($form_function->message))
                {{ Helpers::alert( $form_function->type, $form_function->message) }}
            @endif

            @if(session()->has('notifyType'))
                {{ Helpers::formAlert( session('notifyType') ) }}
            @endif

            @if(count($items) > 0)

                <div id="module-list" class="active">

                    @component('admin.clients.components.list', [ 'module' => $module, 'route' => $route, 'items' => $items ])
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
