<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|between:1,40',
            'password' => 'required|string|between:1,20',
        ]);

        $user = User::query()
            ->where('email', '=', $request['email'])
            ->first();
        if ($user === null) {
            $request->validate(['username' => 'required|string|between:1,20']);
            $user = User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return back();
        } else {
            if (!Hash::check($request['password'], $user->password)) {
                return back()->withErrors(['email' => 'Wrong email or password']);
            } else {
                Auth::login($user);

                $request->session()->regenerate();

                return back();
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
