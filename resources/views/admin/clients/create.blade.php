@extends('admin.templates.basic')

@section('title', 'Clientes | Adicionar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('admin.clients.components.form', [ 'form_function' => 'add' ])
            @endcomponent

        </div>

    </section>

@endsection
