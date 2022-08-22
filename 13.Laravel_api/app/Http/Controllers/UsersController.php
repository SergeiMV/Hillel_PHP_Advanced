<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function create(Request $request)
    {
        $user = $request->validate([
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $user['password'] = Hash::make($user['password']);
        $user['remember_token'] = Str::random(10);

        \App\Models\User::create($user);
        return response()->json($user['remember_token']);
    }

    public function store(Request $request)
    {
        $users = $request->validate([
            '*.username' => ['required', 'unique:users'],
            '*.password' => ['required'],
            '*.email' => ['required', 'email', 'unique:users'],
        ]);

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            $user['remember_token'] = Str::random(10);

            $tokens[] = [$user['username'] => $user['remember_token']];

            \App\Models\User::create($user);
        };
        return response()->json($tokens);
    }
}
