<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginRegisterController extends Controller
{
    public function login() {
       $result = DB::table('users')->where('username', request('loginUsername'))->where('password', request('loginPassword'))->first();

       if (!$result)
           return view('/loginRegister', [
               "loginFailureMessage" => "No one found with those credentials please try again."
           ]);

       $_SESSION['userID'] = $result->id;
       return redirect('/user/' . $result->username)->with('user', $result);
    }

    public function register() {
        /*Test if all fields were filled*/
        if (
            null === (request('firstname')) ||
            null === (request('lastname')) ||
            null === (request('email')) ||
            null === (request('username')) ||
            null === (request('password')) ||
            null === (request('passwordconf'))
        )
        {
            return view('/loginRegister', ['registerFailureMessage' => 'All Fields Required']);
        }

        /*Test if password was the same as password confirmation*/
        if (request('password') !== request('passwordconf')) {
            return view('/loginRegister', [
                "registerFailureMessage" => "Your passwords Do not match"
            ]);
        }


        /*Create new user, set attributes, save to DB*/
        $user = new \App\user();

        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->email = request('email');
        $user->username = request('username');
        $user->password = request('password');

        if (request('isAdmin'))
            $user->isAdmin = 1;
        else
            $user->isAdmin = 0;

        $user->save();

        $userID = DB::table('users')->where('username', request('username'))->where('password', request('password'))->get('id');

        $_SESSION['userID'] = $userID->id;

        return redirect('/')->with("firstname", request('firstname'))->with("lastname", request('lastname'));
;
    }

    public function show() {
        return view('loginRegister');
    }
}
