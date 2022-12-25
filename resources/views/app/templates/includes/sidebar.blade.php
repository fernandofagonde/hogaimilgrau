<aside>

    <div class="logo">

        <div><a href="/app" title="{{ config('app.name_client') }}"><img src="/assets/images/app/icon.png"></a></div>
        <span>{{ config('app.name_client') }}</span>

    </div>

    @php echo Helpers::sidebar('app') @endphp

    <div class="profile">

        <div class="profile-content">

            <a class="link-profile" href="{{ route('app.profile.index') }}" target="_blank">@php echo Html::icon('icon-users') @endphp</a>

            <div>
                {{ $loginController::getName() }}
            </div>

            <a class="link-logout" href="{{ route('app.logout') }}">@php echo Html::icon('icon-log-out') @endphp</a>
    </div>

</aside>
