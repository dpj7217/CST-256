<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;

class UserController extends Controller
{
    public function show($username) {
        $user = User::where('username', $username)->first();

        if (!$user)
            abort(404);

        return view('users', [
            "user" => $user
        ]);
    }
}
