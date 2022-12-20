<aside>

    <div class="logo">

        <div><a href="/admin" title="{{ env('APP_NAME') }}"><img src="/assets/img/logo-icon.png"></a></div>
        <span>{{ env('ADM_NAME') }}</span>

    </div>

    @php echo Helpers::sidebar('admin') @endphp

    <div class="profile">

        <div class="profile-content">

            <a class="link-profile" href="{{ route('admin.profile.index') }}" target="_blank">@php echo Html::icon('icon-users') @endphp</a>

            <div>
                {{ $loginController::getName() }}<br><small>{{ $loginController::getType() }}</small>
            </div>

            <a class="link-logout" href="{{ route('admin.logout') }}">@php echo Html::icon('icon-log-out') @endphp</a>
    </div>

</aside>
