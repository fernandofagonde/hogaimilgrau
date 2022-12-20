@extends('admin.templates.basic')

@section('title', 'Blog / Publicações / Editar')

@section('body')

    <section class="section">

        <div class="section-body">

            <h1 class="section-title">Editar Publicação</h1>

            @component('admin.blog_posts.componentes.form', [ 'form_function' => 'edit', 'categories' => $categories, 'post' => $post ])
            @endcomponent

        </div>

    </section>

@endsection
