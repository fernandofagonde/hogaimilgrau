@php

// Basic Route Name
$module = 'blog-posts';
$route = 'admin.'. $module;

// Messages
$messages = [
    'emptyList' => [
        'title' => 'Nada a mostrar!',
        'message' => 'Nenhuma publicação foi realizada até o momento.'
    ],
];

@endphp

@extends('admin.templates.basic')

@section('title', 'Blog / Publicações / Listando')

@section('body')

    <section class="section">

        <div class="section-body">

            @php
                echo Helpers::moduleBar($route, true, (session()->has('keywords') ? session('keywords') : ''))
            @endphp

            @if(isset($form_function) && isset($form_function->type) && isset($form_function->message))
                {{ Helpers::alert( $form_function->type, $form_function->message) }}
            @endif

            @if (session()->has('notifyType'))
                {{ Helpers::formAlert( session('notifyType') ) }}
            @endisset

            @if(count($posts) > 0)

                <div id="module-list" class="active">

                    <ul class="list">

                        <li class="list-header">
                            <div class="w-10 align-center">#</div>
                            <div class="w-40">Título / Url</div>
                            <div class="w-20 align-center">Categoria</div>
                            <div class="w-15 align-center">Status</div>
                            <div class="w-15 align-center">Opções</div>
                        </li>

                        @foreach($posts as $index => $post)

                            <li class="list-item">
                                <div data-label="#" class="w-10 align-center">{{ $post->id }}</div>
                                <div data-label="Título / Url" class="w-40 no-flex">{{ $post->title }}<br><small>{{ url($post->category_slug .'/'. $post->slug_date .'/'. $post->slug) }}</small></div>
                                <div data-label="Categoria" class="w-20 align-center">{{ $post->category_name }}</div>
                                <div data-label="Status" class="w-15 align-center">@php echo Html::tableSwitch($module.'/status', $post->id, $post->published) @endphp</div>
                                <div data-label="Opções" class="w-15 list-buttons">
                                    <button type="button" class="button button-info button-list-edit" data-module="{{ $module }}" data-id="{{ $post->id }}"><i class="icon-edit"></i><span>Editar</span></button>
                                    <button type="button" class="button button-danger button-list-del" data-module="{{ $module }}" data-id="{{ $post->id }}"><i class="icon-trash"></i><span>Apagar</span></button>
                                </div>
                            </li>

                        @endforeach

                    </ul>

                    @if($posts->total() > 1)

                        <div class="pagination">

                            @for($i=0; $i<$posts->total(); $i++)

                                @php  $page = $i+1; @endphp

                                <div class="pagination-link @if($posts->currentPage() == $page) active @endif">
                                    <a href="{{ route($route.'.search') }}?page={{ $page }}" title="Página {{ $page }}">{{ $page }}</a>
                                </div>

                            @endfor

                        </div>

                    @endif

                </div>

            @else

                <div id="module-list-empty">
                    <h1>{{ $messages['emptyList']['title'] }}</h1>
                    <h2>{{ $messages['emptyList']['message'] }}</h2>
                </div>

            @endif

        </div>

    </section>

@endsection
