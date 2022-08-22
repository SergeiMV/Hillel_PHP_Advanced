<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upvotes;

class UpvotesController extends Controller
{
    public function vote(Request $request)
    {

        $user = \App\Models\User::where('remember_token', $request->remember_token)->first();
        $post = \App\Models\Post::find($request->post);

        $upvoteCheck = \App\Models\Upvote::where('post_id', $post->id)->where('user_id', $user->id)->first();
        if ($upvoteCheck) {
            return response()->json(["message" => "Error, already upvoted"]);
        }

        $upvote = \App\Models\Upvote::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        $post->update(['upvotes_count' => $post->upvotes_count + 1]);
        return response()->json(["message" => "Successfully upvoted"]);
    }

    public function unvote(Request $request)
    {
        $user = \App\Models\User::where('remember_token', $request->remember_token)->first();
        $post = \App\Models\Post::find($request->post);

        $upvoteCheck = \App\Models\Upvote::where('post_id', $post->id)->where('user_id', $user->id)->first();
        if (!$upvoteCheck) {
            return response()->json(["message" => "Error, no vote for this post"]);
        }

        \App\Models\Upvote::where('id', '=', $upvoteCheck->id)
            ->update(['deleted_at' => \Carbon\Carbon::now()
            ->toDateTimeString()]);
        $post->update(['upvotes_count' => $post->upvotes_count - 1]);
        return response()->json(["message" => "Successfully unvoted"]);
    }
}
