@extends('app.templates.basic')

@section('title', 'Pessoas | Editar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('app.people.components.form', [ 'form_function' => 'edit', 'people' => $people ])
            @endcomponent

        </div>

    </section>

@endsection

@section('js')
    <script src="/assets/js/app/modules/people.js"></script>
@endsection
