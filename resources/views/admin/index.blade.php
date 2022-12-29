@extends('admin.templates.basic')

@section('title', 'Admin Hogai | Dashboard')

@section('body')

<section class="section">

    <div class="section-body">

        @if (session()->has('notifyType'))
            {{ Helpers::loginAlert( session('notifyType') ) }}
        @endif

        @component('admin._components.dashboard', compact(['stats']))
        @endcomponent

    </div>

</section>

@endsection

@section('styles')
    <link rel="stylesheet" href="/assets/css/admin/dashboard.css">
@endsection
