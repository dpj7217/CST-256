<?php
/*
    Project:
        Socialis: V1.0
    Module:
        Socialis: V1.0
    Author:
        David Pratt Jr.
    Date:
        6/14/2020
    Synopsis:
        controller to handler login register logic



*/


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class LoginRegisterController extends Controller
{
    public function login() {
        request()->validate([
            'loginUsername' => ['required', 'max:255'],
            'loginPassword' => ['required', 'max:255']
        ]);

        $user = DB::table('users')->where('username', request('loginUsername'))->where('password', request('loginPassword'))->first();

       if (!$user)
           return view('/loginRegister', [
               "loginFailureMessage" => "No one found with those credentials please try again."
           ]);

       $_SESSION['userID'] = $user->id;

       $profile = DB::table('profiles')->where('userID', $user->id)->get();

       if (!$profile->isEmpty()) {
           return redirect('/profile/' . $user->id . '/view')->with('user', $user);
       } else {
           return redirect('/profile/' . $user->id . '/create');
       }
    }

    public function register() {
        /*Test if all fields were filled*/
        request()->validate([
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'username' => ['required', 'max:255'],
            'password' => ['required', 'max:255'],
            'passwordconf' => ['required', 'max:255', 'same:password']
        ]);


        /*Create new user, set attributes, save to DB*/
        $user = \App\user::create([
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
            'email' => request('email'),
            'username' => request('username'),
            'password' => request('password'),
            'isAdmin' => 0,
            'isActive' => 1
        ]);

        return redirect('/profile/' . $user->id . '/create');
    }

    public function show() {
        return view('loginRegister');
    }
}
