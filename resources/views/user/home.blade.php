@extends('user.layouts.app')

@section('content')
    <div class="header">
        <div class="home-header">
            <a href="{{ route("user.home.index") }}">
                <img src="{{ asset("assets/user/img/title.svg")}}">
            </a>
            <p class="add_fieldbtn orange non-icon f-right mt10 text-center"><a>register</a></p>
        </div>
    </div>
@endsection


@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/user/css/page/home.css') }}?202001211050">
@endsection
