@php

    // Module
    $module = 'people';
    $route = 'app.'. $module;

    // Messages
    $messages = [
        'emptyList' => [
            'title' => 'Nada foi encontrado!',
            'message' => 'Nenhuma pessoa foi encontrada com os termos informados, <a href="/app/people">clique aqui</a> e veja todas as pessoas cadastradas.'
        ]
    ];

@endphp

@extends('app.templates.basic')

@section('title', 'Pessoas | Buscando')

@section('body')

    <section class="section">

        <div class="section-body">

            @php
                echo Helpers::moduleBar($route, true, ((isset($kwd)) ? $kwd : ''), 'Busque pelo nome, e-mail ou documento...');
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

                    @component('app.people.components.list', [ 'module' => $module, 'route' => $route, 'request' => $request, 'items' => $items ])
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
