@extends('app.templates.basic')

@section('title', 'App Hogai | Dashboard')

@section('body')

<section class="section">

    <div class="section-body">

        @if (session()->has('notifyType'))
            {{ Helpers::loginAlert( session('notifyType') ) }}
        @endif

        @component('app._components.dashboard',[
            'stats' => $stats,
            'payable' => $payable,
            'receivable' => $receivable
        ])
        @endcomponent

    </div>

</section>

@endsection
