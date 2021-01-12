@php
    $route_name =  Route::currentRouteName();
@endphp

<p class="back"><a href="#" onclick="javascript:window.history.back(-1);return false;"><img src="{{ asset('assets/admin/img/back.png') }}" alt="戻る"></a></p>
<!-- <h1 class="logo"><img src="img/logo.png" alt="UJ レンタル"></h1> -->
<p class="menu"><img src="{{ asset('assets/admin/img/menu.png') }}" alt="スマホメニュー"></p>
<div class="demo acc switch">
    <ul id="nav">
        <a class="menu-trigger">
            <span></span>
            <span></span>
            <span></span>
        </a>

        <li>
            <a href="{{ route('admin.dashboard.index') }}" >
                <span class="nav-icon"><img src="{{ asset('assets/admin/img/nav-icon13.png') }}"></span>
                <span class="nav-text">Home</span>
            </a>
        </li>

    </ul>
</div>
