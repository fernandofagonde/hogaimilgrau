@extends('app.templates.basic')

@section('title', 'Contas à Receber | Editar')

@section('body')

    <section class="section">

        <div class="section-body">

            @component('app.receivable_bills.components.form', [ 'form_function' => 'edit', 'bill' => $bill, 'peopleList' => $peopleList ])
            @endcomponent

        </div>

    </section>

@endsection

@section('js')
    <script src="/assets/js/app/modules/receivable_bills.js"></script>
@endsection
