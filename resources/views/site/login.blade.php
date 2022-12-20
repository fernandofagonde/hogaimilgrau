@extends('site.templates.login')

@section('title', 'Identificação App Hogai')
@section('description', 'Identificação App Hogai.')

@section('body')

    <section class="section">

        <div class="section-body">

            <div id="form-login">

                <h1 id="form-title">
                    <img src="/assets/images/site/login-logo.png" alt="logo da empresa Hogai"/>
                </h1>

                @if (session()->has('notifyType'))
                    {{ Helpers::loginAlert( session('notifyType') ) }}
                @endif

                <form action="{{ route('site.login') }}" method="POST">
                    @csrf

                    <div class="form-field">
                        <label for="email">Endereço de E-mail</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Preencha seu e-mail">
                        @if($errors->has('email'))
                            <small style="color: red">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="form-field">
                        <label for="email">Senha de Acesso</label>
                        <input type="password" name="password" value="" placeholder="******">
                        @if($errors->has('password'))
                            <small style="color: red">{{ $errors->first('password') }}</small>
                        @endif
                    </div>

                    <button type="submit" id="login-button">Identificar</button>

                </form>

            </div>

        </div>

    </section>

@endsection
