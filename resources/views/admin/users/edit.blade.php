@extends('admin.layouts.app')

@section('content')
    <div id="wrapper">
        <div id="r-content">
            <div class="title_wrap">
                <h2 class="title">会員情報編集</h2>
            </div>

            {{ Form::open(['route' => ['admin.users.update', 'id'=>$user->id], 'id' => 'users-form', 'name' => 'users-form', 'method' => 'PUT']) }}
            <div class="contents_wrap">
                <div class="table_wrap">
                    <div class="table_inner">
                        <table class="normal">
                            <th>１．登録したい種別にチェックをして下さい（複数回答可）</th>
                            <td>
                                <p class="input-text" >
                                    @foreach(config('const.user_kind_name') as $key=>$value)
                                        @if($user->checkDataField($key))
                                            {{ $value }}、
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                        </table>
                    </div>
                </div>
            </div>

            <div class="btn type1" style="float: left;">
                <a href="{{ route("admin.users.index", $return_params) }}">戻る</a>
            </div>
            <div class="btn type1 some">
                <input type="submit" value="更新" id="btnCreate">
            </div>

            {{ Form::close() }}
        </div>
    </div>

    <div id="dialog" title=""></div>
@endsection

@section('page_css')
    <link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datetimepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('page_js')
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/ja.js') }}"></script>
    <script src="{{ asset('vendor/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
    </script>
@endsection
