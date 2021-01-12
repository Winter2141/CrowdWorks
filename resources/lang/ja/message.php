<?php

return [
    // メールアドレスの確認
    "Verify" => [
        "Title" => "メールアドレスの確認",
        "NewUrl" => "新しく確認用のURLを送信しました。",
        "SendActionUrl" => "送られたメールを確認してURLをクリックして下さい。",
        "NotEmail" => "メールが届いていない場合は、<a href=':url'>こちら</a>をクリックして下さい。"
    ],

    // メール
    "Mail" => [
        "Opning" => "ご利用ありがとうございます。",
        "Whoops" => "ご迷惑をおかけいたします。",
        "Regards" => "引き続きご利用の程、よろしくお願いいたします。",
        "NotClick" =>"「:actionText」がクリックできない場合は以下のURLをブラウザにコピーして下さい。\n[:actionURL](:actionURL)",

        // メールアドレスの確認
        "Verify" => [
            "Title" => "メールアドレスの確認",
            "Line" => "メールアドレスを確認するには、下のボタンをクリックしてください。",
            "Action" => "メールアドレスを確認",
            "PasswordLine" =>"あなたのパスワードは「:password」です。",
            "OutLine" =>"このメールにお心当たりがない場合、本メールは破棄して頂きますようお願いいたします。"
        ],

        //Reset Password Email To Staff
        "ResetPassword" => [
            "Title" => "パスワードリセット",
            "Line1" => "お客様のアカウントのパスワードリセットリクエストが届いているため,このメールが届いています。",
            "Action" => "パスワードリセット",
            "Line2" => "このパスワードのリセットリンクは:count分以内に期限切れになります。",
            "Line3" => "パスワードのリセットを要求しなかった場合は,これ以上の処置は不要です。",
        ],

        //Send Message Email to Partner
        "MessageEmail" => [
            "Title" => "メッセージ受信",
            "NewLine" => ":partner様から新しいメッセージが受信されました。",
            "ClickLine" => "メッセージを確認したら、下のボタンをクリックしてください。",
            "Action" => "メッセージ確認",
        ],

        //Send Email for inviting friend
        "InviteFriendEmail" => [
            "Title" => "友達申請",
            "NewLine" => ":partner様から友達申請が受信されました。",
            "ClickLine" => "申請を確認したら、下のボタンをクリックしてください。",
            "Action" => "申請確認",
        ],

        //Send Email for confirming monthly fee payment
        "ConfirmFeePayment" => [
            "MonthlyTitle" => "月額決済",
            "ConfirmPaid" => ":month月分料金「¥:amount」が決済されました。",
            "ConfirmFailed" => ":month月分料金決済が失礼いたしました。",
            "CheckRegisteredCard" => "クレジットカード情報を確認してください。",
            "FailedClickLine" => "クレジットカード情報を確認したら、下のボタンをクリックしてください。",
            "NoCard" => "登録されたクレジットカードがありません。",
            "RegisterClickLine" => "クレジットカードを登録したら、下のボタンをクリックしてください。",
            "Action" => "クレジットカード設定",
        ],
    ]
];