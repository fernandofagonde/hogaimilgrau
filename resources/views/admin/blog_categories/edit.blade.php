@extends('admin.templates.basic')

@section('title', 'Blog / Categorias')

@section('body')

    <section class="section">

        <div class="section-body">

            <h1 class="section-title">Editar Categoria</h1>

            @component('admin.blog_categories.componentes.form', [ 'form_function' => 'edit', 'category' => $category ])
            @endcomponent

        </div>

    </section>

@endsection

