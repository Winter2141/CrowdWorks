@extends('admin.layouts.app')

@section('content')

    <div id="wrapper">
        <div id="r-content">

            @include('admin.layouts.flash-message')
            @yield('content')

            <div class="contents_wrap">
                <div class="table_wrap">
                    {{ $users->links('vendor.pagination.admin-pagination') }}
                    <div class="table_inner">
                        <table class="normal type3">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@sortablelink('namekanji', ' 氏名（漢字）')</th>
                                <th>@sortablelink('namekana', ' 氏名（カナ）')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->count() > 0)
                            @foreach ($users as $record)
                                <tr>
                                    <td>
                                        <p><a href="{{ route('admin.users.show', ['id'=>$record->id]) }}">詳細</a></p>
                                        <p><a href="{{ route('admin.users.edit', ['id'=>$record->id]) }}">編集</a></p>
                                    </td>
                                    <td class="text-left">{{ $record->name_kanji }}</td>
                                    <td class="text-left">{{ $record->name_kana }}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="1" style="text-align: left; border-color: white;">データが存在しません。</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links('vendor.pagination.admin-pagination') }}
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-confirm" title="test" style="display:none">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>
            <span id="confirm_text"></span></p>
    </div>
@endsection

@section('page_css')
    <link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
@endsection

@section('page_js')
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/pages/helper.js') }}"></script>
@endsection