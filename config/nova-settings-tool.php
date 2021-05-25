<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings Path
    |--------------------------------------------------------------------------
    |
    | Path to the JSON file where settings are stored.
    |
    */

    'path' => storage_path('app/settings.json'),

    /*
    |--------------------------------------------------------------------------
    | Sidebar Label
    |--------------------------------------------------------------------------
    |
    | The text that Nova displays for this tool in the navigation sidebar.
    |
    */

    'sidebar-label' => 'Settings',

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | The good stuff :). Each setting defined here will render a field in the
    | tool. The only required key is `key`, other available keys include `type`,
    | `label`, `help`, `placeholder`, `language`, and `panel`.
    |
    */

    'settings' => [
        [
            'key' => 'wordsperminute',
            'label' => 'Word per Minute',
            'type' => 'number',
            'help' => 'The average amount of words read per minute',
        ],

        [
            'key' => 'tracking_scripts',
            'label' => 'Tracking scripts',
            'type' => 'textarea',
            'help' => 'Tracking scripts',
        ],

        [
            'key' => 'facebook_social',
            'label' => 'Facebook url',
            'type' => 'text',
            'help' => 'Facebook url',
        ],

        [
            'key' => 'instagram_social',
            'label' => 'Instagram url',
            'type' => 'text',
            'help' => 'Instagram url',
        ],
    ],

];
