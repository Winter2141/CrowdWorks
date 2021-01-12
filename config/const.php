<?php

return [
    'user_kind_name' => [
        'f_1001' => '業務委託',
        'f_1002' => 'マネジメント契約',
        'f_1003' => '契約社員',
        'f_1004' => '社員_1 （Beaumax及び関連会社）',
        'f_1005' => 'インターン（学生・または、それに準ずる者）',
        'f_1006' => 'アシスタント',
        'f_1007' => '社員_2 （化粧品・美容関係企業への就職・転職）',
    ],

    'jp_week' => [
        '0' => '日',
        '1' => '月',
        '2' => '火',
        '3' => '水',
        '4' => '木',
        '5' => '金',
        '6' => '土',
    ],

    'member_code' => [

    ],

    'payment_type' => [
        '1' => 'クレジットカード',
        '2' => '銀行振込',
        '3' => 'コンビニ支払'
    ],

    'payment_credit_type' => 1,


    'type_vascular' => 1,
    'type_non_vascular' => 2,

    'departments' => [

    ],

    'occupations' => [

    ],

    'register_status' => [
        1 => '仮登録',
        2 =>  '本登録'
    ],
    'user_half_register_status'=> 1,
    'user_register_status'=> 2,


    'enable_status' => [
        1 => '無効',
        2 => '有効'
    ],
    'user_disable_status' => 1,
    'user_enable_status' => 2,

    'news_target_type' => [
        'all' => 1,
        'personal' => 2,
        'multi_user' => 3,
        'user_kind' => 4
    ],
    'news_target_type_name' => [
        '1' => 'All',
        '2' => '個別',
        '3' => '複数',
        '4' => '特定の種別に属する会員',
    ],

    'public_status' => [
        'no_public' => 0,
        'public' => 1,
    ],
    'public_status_name' => [
        '0' => '非公開',
        '1' => '公開',
    ],

    'friend_request' => [
        'sender' => 1,
        'receptionist' => 2,
    ],
    'friend_request_status' => [
        'waiting' => 1,
        'accepted' => 2,
        'rejected' => 3
    ],

];