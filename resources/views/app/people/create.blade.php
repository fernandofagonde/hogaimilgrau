@extends('app.templates.basic')

@section('title', 'Pessoas | Adicionar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('app.people.components.form', [ 'form_function' => 'add' ])
            @endcomponent

        </div>

    </section>

@endsection

@section('js')
    <script src="/assets/js/app/modules/people.js"></script>
@endsection
