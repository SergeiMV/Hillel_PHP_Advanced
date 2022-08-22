<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:posts'],
            'link' => ['required', 'unique:posts'],
            'remember_token' => ['required'],
        ]);

        $author = \App\Models\User::where('remember_token', $data['remember_token'])->first();

        $createdPost = [
            'title' => $data['title'],
            'link' => $data['link'],
            'author_name' => $author['username'],
            'author_id' => $author['id'],
        ];

        $post = \App\Models\Post::Create($createdPost);
        return response()->json($post);
    }

    public function read(Request $request)
    {
        $post = \App\Models\Post::find($request->post);
        $requestedPost = [
            'id' => $post->id,
            'title' => $post->title,
            'link' => $post->link,
            'upvotes_count' => $post->upvotes_count,
            'author_name' => $post->author_name,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
        ];
        return response()->json($requestedPost);
    }

    public function update(Request $request)
    {
        $post = \App\Models\Post::find($request->post);
        $updatedPost = $request->validate([
            'title' => ['required'],
            'link' => ['required'],
        ]);

        $post->update($updatedPost);
        return response()->json($updatedPost);
    }

    public function destroy(Request $request)
    {
        $post = \App\Models\Post::find($request->post);
        $upvotes = $post->upvotes();
        $comments = $post->comments();
        \App\Models\Upvote::where('id', '=', $upvote->id)->update(['deleted_at' => Carbon::now()->toDateTimeString()]);
        \App\Models\Comment::where('id', '=', $comment->id)->update(['deleted_at' => Carbon::now()->toDateTimeString()]);
        \App\Models\Post::where('id', '=', $post->id)->update(['deleted_at' => Carbon::now()->toDateTimeString()]);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
