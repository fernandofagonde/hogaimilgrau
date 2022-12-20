@extends('admin.templates.basic')

@section('title', 'Blog / Publicações / Adicionar')

@section('body')

    <section class="section">

        <div class="section-body">

            <h1 class="section-title">Adicionar Publicação</h1>

            @component('admin.blog_posts.componentes.form', [ 'form_function' => 'add', 'categories' => $categories ])
            @endcomponent

        </div>

    </section>

@endsection
