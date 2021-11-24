<?php

return [
    'allowed_locales' => [
        'en' => [
            'text' => 'English',
            'domain' => config('app.url'),
        ],
        'nl' => [
            'text' => 'Dutch',
            'domain' => 'https://livinggod.nl'
        ]
    ],

    'default_locale' => 'en',
];
