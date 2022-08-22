<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->remember_token !== null) {
            $user = \App\Models\User::where('remember_token', $request->remember_token)->first();
            if (!$user) {
                return response()->json(['message' => 'Wrong token']);
            }
        } else {
            return response()->json(['message' => 'Wrong token']);
        }
        return $next($request);
    }
}
