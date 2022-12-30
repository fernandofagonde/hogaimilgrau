@php

    $image = $loginController::getImage();

@endphp

<aside>

    <div class="logo">

        <div><a href="/admin" title="{{ config('app.name_admin') }}"><img src="/assets/images/app/icon.png"></a></div>
        <span>{{ config('app.name_admin') }}</span>

    </div>

    @php echo Helpers::sidebar('admin') @endphp

    <div class="profile">

        <div class="profile-content">

            <a class="link-profile @php if($image != '') { echo 'profile-image'; } @endphp" href="{{ route('admin.profile.index') }}" target="_blank"@php

                if($image != '') {

                    echo ' style="--bg-image: url('. url("content/admin/profile") .'/thumb/'. $image .');"';

                }

            @endphp>@php if($image == '') { echo Html::icon('icon-users'); } @endphp</a>

            <div>
                {{ $loginController::getName() }}
            </div>

            <a class="link-logout" href="{{ route('admin.logout') }}">@php echo Html::icon('icon-log-out') @endphp</a>
    </div>

</aside>
