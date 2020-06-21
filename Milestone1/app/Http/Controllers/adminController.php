<?php

namespace App\Http\Controllers;

use App\Demographics;
use App\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function showUsers() {
        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return view('users', [
            'users' => $users,
            'demographics' => $demographics
        ]);
    }

    public function suspendUser() {
        $userID = request('userID');

        $user = User::where('id', $userID)->first();
        $user->isActive = 0;
        $user->update();

        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return redirect('/admin/users')->with('users', $users)->with('demographics', $demographics);
    }

    public function deleteUser() {
        $userID = request('userID');

        $user = User::where('id', $userID)->first();

        $user->delete();

        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return redirect('/admin/users')->with('users', $users)->with('demographics', $demographics);
    }

    public function reactivateUser() {
        $userID = request('userID');

        $user = User::where('id', $userID)->first();

        $user->isActive = 1;
        $user->update();

        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return redirect('/admin/users')->with('users', $users)->with('demographics', $demographics);
    }

    public function toAdmin() {
        $userID = request('userID');

        $user = User::where('id', $userID)->first();
        $user->isAdmin = 1;
        $user->update();

        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return redirect('/admin/users')->with('users', $users)->with('demographics', $demographics);
    }

    public function fromAdmin() {
        $userID = request('userID');

        $user = User::where('id', $userID)->first();
        $user->isAdmin = 0;
        $user->save();

        $users = User::latest()->get();
        $demographics = Demographics::latest()->get();

        return redirect('/admin/users')->with('users', $users)->with('demographics', $demographics);
    }
}
