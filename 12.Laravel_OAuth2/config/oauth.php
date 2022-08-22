<?php

return [
    'reddit' => [
        'client_id' => env('OAUTH_REDDIT_CLIENT_ID'),
        'client_secret' => env('OAUTH_REDDIT_CLIENT_SECRET'),
        'callback_uri' => env('OAUTH_REDDIT_CALLBACK_URI'),
    ]
];
