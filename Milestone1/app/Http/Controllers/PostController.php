<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function store() {
        if (!request('post_text'))
            return redirect()->back()->with('error', "Your post must include a body to submit it.");

        //add post to table
        Post::create([
            'post_text' => request('post_text'),
            'user_id' => \Auth::user()->id
        ]);

        return redirect('/profile/' . \Auth::user()->id . '/view');
    }
}
