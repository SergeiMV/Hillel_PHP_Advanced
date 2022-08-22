<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ad;
use Illuminate\Http\Request;

class EnsureEditAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('ad') !== null) {
            $object = $request->route('ad');
            if (gettype($object) !== 'object') {
                $object = Ad::find($object);
            }
            if ($object->author_id !== \Illuminate\Support\Facades\Auth::user()->id) {
                return abort('403');
            }
        }
        return $next($request);
    }
}
