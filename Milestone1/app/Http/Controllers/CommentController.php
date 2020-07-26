<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function create($post_id) {
        if (!request('comment_text'))
            return redirect()->back()->with($post_id . '_error', "You must have a comment body to comment on this post");

        Comment::create([
            'post_id' => $post_id,
            'user_id' => \Auth::user()->id,
            'comment_text' => request('comment_text')
        ]);

        return redirect()->back();
    }
}
