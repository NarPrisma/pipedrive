<?php


return [
    'pipedrive' => [
        'id' => env('PIPEDRIVE_ID'),
        'secret' => env('PIPEDRIVE_SECRET'),
        'endpoint' => env('PIPEDRIVE_ENDPOINT'),
        'oauth' => "https://oauth.pipedrive.com/oauth",
        'redirect' => env('APP_URL')."/pipedrive/callback",
    ],

    'pipedrive_custom_ui' => [
        'oauth' => "https://oauth.pipedrive.com/oauth",
        'redirect' => env('APP_URL')."/pipedrive/custom_ui/callback",
        'endpoint' => env('PIPEDRIVE_CUSTOM_UI_ENDPOINT'),
    ],

    'labels' => [
        'hot' => '0df253ac-071d-4283-b97a-b0ea4a81f66d',
        'warm' => '144bd02d-a212-4fbe-9720-920963af88a2',
        'cold' => '2f2c7130-da8d-4381-b871-6f6ae03bbc5d',
    ],

];