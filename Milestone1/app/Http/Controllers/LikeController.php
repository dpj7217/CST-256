<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function create($post_id) {
       Like::create([
           'user_id' => \Auth::user()->id,
           'post_id' => $post_id
       ]);

       return redirect()->back();
    }
}
