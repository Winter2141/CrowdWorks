@extends('admin.layouts.app')

@section('content')
    <div id="wrapper">
        <div id="r-content">
            <div class="title_wrap">
                <h2 class="title">会員詳細</h2>
            </div>
            <div class="contents_wrap">
                <div class="table_wrap">
                    <div class="table_inner">
                        <table class="normal">
                            <th>１．登録したい種別にチェックをして下さい（複数回答可）</th>
                            <td>
                                <p class="input-text" >
                                    @foreach(config('const.user_kind_name') as $key=>$value)
                                        @if($user->checkDataField($key))
                                            {{ $value }}
                                            @if(! $loop->last)
                                                、
                                            @endif
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                        </table>
                    </div>
                </div>
            </div>

            <div class="btn type1">
                <a href="{{ route("admin.users.index", $return_params) }}">戻る</a>
            </div>
        </div>
    </div>

    <div id="dialog" title=""></div>
@endsection

@section('page_css')
    <link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
@endsection

@section('page_js')
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
    </script>
@endsection
