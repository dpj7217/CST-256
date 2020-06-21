<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\user;
use \App\Profile;
use \App\Demographics;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function create($userID) {
        if ($result = Profile::find('userID')) {
            return redirect('/profile/' . $userID . "/edit")->with(['result' => $result]);
        }

        return view('createDemoInfo', [
            'userID' => $userID
        ]);
    }

    public function show($userID) {
        return view('profile', [
            'user' => User::find($userID),
            'profile' => Profile::where('userID', $userID)->first(),
            'demographics' => \App\Demographics::where('profileID', function($query) use ($userID) {
                $query->select('id')->from('profiles')->where('userID', $userID);
            })->first()
        ]);
    }

    public function addDemographics($userID) {
        /*validate user input*/
        $validatedInput = request()->validate([
            'birthday' => ['required', 'before:tomorrow'],
            'currCity' => ['required'],
            'fromCity' => ['required'],
            'bio' => ['required'],
            'gender' => ['required'],
            'ethnicity' => ['required'],
            'age' =>['required'],
            'inputFile' => ['required', 'file']
        ]);


        /*insert into profiles table and get id*/
        \DB::beginTransaction();


        $avatarPath = request('inputFile')->storeAs('images', $userID . "_img.jpg");

        $profile = Profile::create([
            'userID' => request('userID')
        ]);

        if (!$profile) {
            \DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to add profile');
        }


        $demographics = Demographics::create([
            'profileID' => $profile->id,
            'birthday' => request('birthday'),
            'currentCity' => request('currCity'),
            'fromCity' => request('fromCity'),
            'bio' => request('bio'),
            'gender' => request('gender'),
            'race' => request('ethnicity'),
            'age' => request('age'),
            'profileImageLocation' => $avatarPath
        ]);



        if (!$demographics) {
            \DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to add demographics');
        }

        \DB::commit();


        return redirect('/profile/' . $userID . '/view')->with('user', User::find($userID));
    }
}
