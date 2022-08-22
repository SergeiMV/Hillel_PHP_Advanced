<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Comment;
use Carbon\Carbon;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
        $post = \App\Models\Post::find($request->post);
        $comment = $request->validate([
            'content' => ['required'],
            'remember_token' => ['required'],
        ]);

        $author = \App\Models\User::where('remember_token', $request->remember_token)->first();

        $createdComment = [
            'post_id' => $post->id,
            'author_name' => $author->username,
            'author_id' => $author->id,
            'content' => $comment['content'],
        ];

        $comment = \App\Models\Comment::Create($createdComment);
        return response()->json($comment);
    }

    public function read(Request $request)
    {
        $comment = \App\Models\Comment::find($request->comment);

        $requestedComment = [
            'content' => $comment['content'],
            'author_name' => $comment['author_name'],
            'created_at' => $comment['created_at'],
            'updated_at' => $comment['updated_at'],
        ];

        return response()->json($requestedComment);
    }

    public function update(Request $request)
    {
        $comment = \App\Models\Comment::find($request->comment);
        $updatedComment = $request->validate([
            'content' => ['required'],
        ]);

        $comment->update($updatedComment);
        return response()->json(["message" => "Comment is updated"]);
    }

    public function destroy(Request $request)
    {
        \App\Models\Comment::where('id', '=', $request->comment)
            ->update(['deleted_at' => \Carbon\Carbon::now()
            ->toDateTimeString()]);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
