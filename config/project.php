<?php

return [
    'name' => 'My Application',
    'url' => 'https://laravel.study',
    'decription' => '',

    'tags' => [
        'laravel' => '라라벨',
        'lumen' => '루멘',
        'general' => '자유의견',
        'server' => '서버',
        'tip' => '팁',
    ],

    'sorting' => [
        'view_count' => '조회수',
        'created_at' => '작성일',
    ],

    'cache' => true,

    'locales' => [
        'ko' => '한국어',
        'en' => 'English',
    ],

    'api_domain' => env('API_DOMAIN', 'api.laravel.study'),

    'etag' => true,
];