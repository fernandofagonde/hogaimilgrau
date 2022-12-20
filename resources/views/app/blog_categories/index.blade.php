@extends('admin.templates.basic')

@section('title', 'Blog / Categorias')

@section('body')

    <section class="section">

        <div class="section-body">

            <h1 class="section-title">Categorias / Index</h1>

            <div id="inside-menu">
                <a href="{{ route('admin.blog.categories.add') }}" title="Adicionar Categoria">ADD</a>
            </div>

            @if(isset($form_function) && isset($form_function->type) && isset($form_function->message))

                {{ Helpers::alert( $form_function->type, $form_function->message) }}

            @endif

            @if (session()->has('notifyType'))
                {{ Helpers::formAlert( session('notifyType') ) }}
            @endif

            @foreach($categories as $index => $category)

                {{ $index }}  - {{ $category->name }} - <a href="{{ route('admin.blog.categories.edit', [ $category->id ] ) }}" title="Editar esta categoria">Editar</a>
                <hr>

            @endforeach

        </div>

    </section>

@endsection
