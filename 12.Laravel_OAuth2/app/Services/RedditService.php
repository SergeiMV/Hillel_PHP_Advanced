<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RedditService
{
    public static function link(): string
    {
        $parameters = [
            'client_id' => config('oauth.reddit.client_id'),
            'response_type' => 'code',
            'state' => 'state',
            'redirect_uri' => config('oauth.reddit.callback_uri'),
            'duration' => 'temporary',
            'scope' => 'identity',
        ];

        return 'https://ssl.reddit.com/api/v1/authorize?' . http_build_query($parameters);
    }
}
