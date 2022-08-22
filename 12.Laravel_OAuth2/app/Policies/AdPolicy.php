<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Ad $ad)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return $user->id === $ad->author_id;
    }

    public function update(User $user, Ad $ad)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return $user->id === $ad->author_id;
    }

    public function delete(User $user, Ad $ad)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return $user->id === $ad->author_id;
    }
}
