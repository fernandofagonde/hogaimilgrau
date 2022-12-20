@php

// Basic Route Name
$route = 'admin.blog.posts';

// Messages
$messages = [

    'notFound' => [
        'title' => 'Nenhuma publicação encontrada!',
        'message' => 'Nenhuma publicação foi localizada com os termos informados. <a href="'. route('admin.blog.posts') .'">Clique aqui</a> e veja todas as publicações.'
    ],

];

@endphp

@extends('admin.templates.basic')

@section('title', 'Blog / Publicações / Busca')

@section('body')

    <section class="section">

        <div class="section-body">

            @php
                echo Helpers::moduleBar(route($route), true, old('keywords'))
            @endphp

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

                        @foreach($publicacoes as $index => $publicacao)

                            <li class="list-item">
                                <div class="w-10 align-center">{{ $publicacao->id }}</div>
                                <div class="w-40 no-flex">{{ $publicacao->title }}<br><small>{{ url($publicacao->category_slug .'/'. $publicacao->slug_date .'/'. $publicacao->slug) }}</small></div>
                                <div class="w-20 align-center">{{ $publicacao->category_name }}</div>
                                <div class="w-15 align-center">{{ $publicacao->published }}</div>
                                <div class="w-15 list-buttons">
                                    <button type="button" class="button button-info button-list-edit" data-module="publicacoes" data-id="{{ $publicacao->id }}"><i class="icon-edit"></i><span>Editar</span></button>
                                    <button type="button" class="button button-danger button-list-del" data-module="publicacoes" data-id="{{ $publicacao->id }}"><i class="icon-trash"></i><span>Apagar</span></button>
                                </div>
                            </li>

                        @endforeach

                    </ul>

                </div>

            @else

                <div id="module-list-empty">

                </div>

            @endif

        </div>

    </section>

@endsection
