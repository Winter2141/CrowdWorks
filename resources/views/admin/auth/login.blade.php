@extends('admin.layouts.auth')

@section('content')
    <div id="login-wrap">
        <div id="login">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <h2>{{ __('labels.E-Mail Address') }}</h2>
                {{--<div class="form-content">
                    <input type="text" id="login_id" name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus>
                    @error('login_id')
                        <span  class="error_text">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>--}}
                <div class="form-content">
                    <input type="text" id="login_id" name="login_id" value="{{ old('login_id') }}" required autocomplete="email" autofocus>
                    @error('login_id')
                        <span  class="error_text">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h2>{{ __('labels.Password') }}</h2>
                <div class="form-content">
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span  class="error_text">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-content">
                    <input type="checkbox" id="learn">
                    <label for="learn">{{ __('labels.Remember Me') }}</label>
                </div>

                <div class="form-content">
                    <input type="submit" value="{{ __('labels.Login') }}">
                </div>

            </form>

        </div>
    </div>
@endsection

@section('page_css')
    <link href="{{ asset('assets/admin/css/page/login.css') }}" rel="stylesheet">
@endsection


