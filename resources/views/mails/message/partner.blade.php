@component('mail::message')
    {!! "{$partner}からメッセージが届きました。。<br/>" !!}
    {!! "<br/>" !!}
    {!! "----------------------------------------<br/>" !!}
    {!!  "メッセージ内容: <br/>" !!}
    @if($message)
        {!! $message !!}
    @endif
    {!! "<br/>" !!}
    {!! "メッセージを確認したら、下のボタンをクリックしてください。<br/>" !!}
    {!! "----------------------------------------<br/>" !!}
    {!! "<br/>" !!}
    {!! "下記連絡先までお問い合わせください。<br/>" !!}
    {!! "<br/>" !!}
    {!! "この度はお問い合わせ重ねてお礼申し上げます。<br/>" !!}
    {!! "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br/>" !!}
    {!! "<br/>" !!}
    {!! "株式会社アクトブレーン<br/>" !!}
    {!! "Official web site URL:&nbsp; <a>https://www.actgroup.jp</a><br/>" !!}
    {!! "<br/>" !!}
    {!! "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" !!}

    {{-- Subcopy --}}
    @isset($actionText)
        @component('mail::subcopy')
            @lang(
            "message.Mail.NotClick",
            [
                'actionText' => $actionText,
                'actionURL' => $actionUrl,
            ]
            )
        @endcomponent
    @endisset
@endcomponent