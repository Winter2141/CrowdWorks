<?php

return [

    'account_prefix' => 'IVRPRO',

    'monthly_pay_order_prefix' => 'dummy',
    //'monthly_pay_order_prefix' => 'IVRPROMB',

    'entry_fee' => '1000',

    'dummy_amount' => 1001,

    'payment_method' => [
        'lump' => 10
    ],

    'capture_type' => [
        'onny_credit' => 0, //与信のみ(与信成功後に売上処理を行う必要があります)
        'credit_and_sale' => 1,  //与信売上(与信と同時に売上処理も行います)
    ],

    //TOKEN
    'token_api_key' => "cd76ca65-7f54-4dec-8ba3-11c12e36a548",
    'token_api_url' => "https://api.veritrans.co.jp/4gtoken"
];