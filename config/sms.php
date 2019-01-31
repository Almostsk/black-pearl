<?php
return [

    // This key returns current login and password for sms sending service
    'http' => [
        'dev' => [
            'login' => 'login',
            'password' => 'password'
        ],
        'prod' => [
            'login' => 'login',
            'password' => 'password'
        ]
    ],

    // status explanations just in case it is needed to pass them to the user

    'statuses' => [
        'Accepted' => 'Сообщение принято платформой, но попытка доставки ещё не предпринималась',
        'Enroute' => 'Предпринимаются попытки доставить сообщение',
        'Delivered' => 'Сообщение доставлено получателю',
        'Expired' => 'Исчерпан лимит времени на попытки доставить сообщение',
        'Deleted' => 'Сообщение принудительно удалено из системы администратором',
        'Undeliverable' => 'Сообщение по тем или иным причинам не может быть доставлено',
        'Rejected' => 'Сообщение отвергнуто из-за ошибок в нём',
        'Unknown' => 'Состояние сообщения неизвестно',
    ]


];