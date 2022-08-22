<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdController
{
    public function index()
    {
        $ads = Ad::paginate(5);
        return view('ads.index', compact('ads'));
    }

    public function show(Ad $ad)
    {
        return view('ads.show', compact('ad'));
    }

    public function edit(Ad $ad)
    {
        return view('ads.edit', compact('ad'));
    }

    public function create(Request $request)
    {
        $request = $request->validate([
            'title' => 'required|string|between:3,255',
            'description' => 'required|string|between:3,255',
        ]);
        $request['author_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $request['author_name'] = \Illuminate\Support\Facades\Auth::user()->username;
        $ad = Ad::create($request);
        return redirect()->route('ads.show', ['ad' => $ad->id]);
    }

    public function update(Request $request)
    {
        $ad = Ad::query()
            ->where("id", "=", $request["id"])
            ->first();
        $request = $request->validate([
            'title' => 'required|string|between:3,255',
            'description' => 'required|string|between:3,255',
        ]);
        $ad->update($request, ['updated_at' => now()]);
        return redirect()->route('ads.show', ['ad' => $ad->id]);
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('home');
    }
}
