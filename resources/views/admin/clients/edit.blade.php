@extends('admin.templates.basic')

@section('title', 'Clientes | Editar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('admin.clients.components.form', [ 'form_function' => 'edit', 'client' => $client ])
            @endcomponent

        </div>

    </section>

@endsection
