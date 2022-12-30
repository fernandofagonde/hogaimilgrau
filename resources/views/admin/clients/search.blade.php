@php

    // Module
    $module = 'clients';
    $route = 'admin.'. $module;

    // Messages
    $messages = [
        'emptyList' => [
            'title' => 'Nada foi encontrado!',
            'message' => 'Nenhum cliente foi encontrado com os termos informados, <a href="/admin/clients">clique aqui</a> e veja todos os clientes cadastrados.'
        ]
    ];

@endphp

@extends('admin.templates.basic')

@section('title', 'Clientes | Buscando')

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

            @if ($request->has('keywords'))
                {{ Helpers::formAlert( 'search-results', $route ) }}
            @endif

            @if(count($items) > 0)

                <div id="module-list" class="active">

                    @component('admin.clients.components.list', [ 'module' => $module, 'route' => $route, 'request' => $request, 'items' => $items ])
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
