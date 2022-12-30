@php

    // Module
    $module = 'profile';
    $route = 'admin.'. $module;

@endphp

@extends('admin.templates.basic')

@section('title', 'Minha Conta')

@section('body')

    <section class="section">

        <div class="section-body">

            @if(session()->has('notifyType'))
                {{ Helpers::formAlert( session('notifyType') ) }}
            @endif

            @component('admin.profile.components.form', [ 'module' => $module, 'route' => $route, 'profile' => $profile ])
            @endcomponent

        </div>

    </section>

@endsection

@section('styles')
    <link rel="stylesheet" href="/assets/css/admin/profile.css">
@endsection
