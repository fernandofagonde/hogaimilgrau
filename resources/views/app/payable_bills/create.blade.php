@extends('app.templates.basic')

@section('title', 'Contas à Pagar | Adicionar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('app.payable_bills.components.form', [ 'form_function' => 'add', 'peopleList' => $peopleList ])
            @endcomponent

        </div>

    </section>

@endsection

@section('js')
    <script src="/assets/js/app/modules/payable_bills.js"></script>
@endsection
