<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully');
    }

}
