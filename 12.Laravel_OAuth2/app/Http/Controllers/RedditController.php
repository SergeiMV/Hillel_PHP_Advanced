<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RedditController
{
    public function callback(Request $request)
    {
        $response = Http::asForm()
            ->withBasicAuth(config('oauth.reddit.client_id'), config('oauth.reddit.client_secret'))
            ->post('https://ssl.reddit.com/api/v1/access_token', [
                'grant_type' => 'authorization_code',
                'redirect_uri' => config('oauth.reddit.callback_uri'),
                'code' => $request->get('code'),
            ]);
        $response_array = ($response->body());
        $response_array = json_decode($response_array);
        $token = $response_array->access_token;

        $response = Http::withHeaders(['Authorization' => "bearer " . $token])
            ->get('https://oauth.reddit.com/api/v1/me.json');
        $response_decode = json_decode($response->body());

        $redditUser['username'] = $response_decode->name;

        //Апи реддита не выдает ни пароль, ни эмейл, только имя пользователя и его айди.
        $redditUser['email'] = 'reddit_' . $response_decode->id;

        $user = User::query()
            ->where('email', '=', $redditUser['email'])
            ->first();

        if ($user === null) {
            $user = User::create([
                'username' => $redditUser['username'],
                'email' => $redditUser['email'],
                'password' => Hash::make($request['password']),
                'password' => Hash::make(Str::random(8)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
