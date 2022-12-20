@extends('admin.templates.basic')

@section('title', 'Painel Administrativo | Index')

@section('body')

<section class="section">

    <div class="section-body">

        @if (session()->has('notifyType'))
            {{ Helpers::loginAlert( session('notifyType') ) }}
        @endif

    </div>

</section>

@endsection
