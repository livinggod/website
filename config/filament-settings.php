<?php

return [
    'group' => 'Settings',

    'label' => 'Settings',

    'path' => storage_path('app/settings.json'),

    'fields' => [
        \Filament\Forms\Components\TextInput::make('wordsperminute')->numeric(),
        \Filament\Forms\Components\Textarea::make('tracking_scripts'),
        \Filament\Forms\Components\TextInput::make('facebook_social')->url(),
        \Filament\Forms\Components\TextInput::make('instagram_social')->url(),
    ]
];
