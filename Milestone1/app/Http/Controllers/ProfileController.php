<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\user;
use \App\Profile;
use \App\Demographics;
use \App\jobHistories;
use \App\jobHistoriesDetails;
use \App\educationHistories;
use \App\educationHistoriesDetails;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class ProfileController extends Controller
{
    /*/profile/{userID}/create*/
    public function create($userID) {
        if (\Auth::user()->profile && \Auth::user()->profile->demographics) {
            return redirect('/profile/' . $userID . "/workHistory");
        }

        return view('createDemoInfo', [
            'userID' => $userID
        ]);
    }


    public function show($userID) {
        $user = User::find($userID);

        if (!$user)
            return redirect('/')->with('errorMsg', "There is no user with that user ID");

        $demographics = null;
        $educationHistory = null;
        $workHistory = null;

        if ($condition = $user->profile->demographics)
            $demographics = $condition;

        if ($user->profile->educationHistories)
            $educationHistory = $user->profile->educationHistories->educationHistoriesDetails->all();

        if ($user->profile->jobHistories)
            $workHistory = $user->profile->jobHistories->jobHistoriesDetails->all();

        return view('profile/profile', [
            'user' => $user,
            'profile' => $user->profile,
            'demographics' => $demographics,
            'educationHistory' => $educationHistory,
            'workHistory' => $workHistory,
            'groups' => $user->groups,
            'userID' => $userID
        ]);
    }


    public function edit($userID) {
        request()->validate(
            //rules
            [
                'email'         => ['required'],
                'age'           => ['required'],
                'bio'           => ['required'],
                'birthday'      => ['required'],
                'fromCity'      => ['required'],
                'currentCity'   => ['required']
            ]
        );

        $user = User::find($userID);
        $demographics = $user->profile->demographics;

        $user->email = request('email');

        $demographics->age = request('age');
        $demographics->bio = request('bio');
        $demographics->birthday = request('birthday');
        $demographics->fromCity = request('fromCity');
        $demographics->currentCity = request('currentCity');

        $user->update();
        $demographics->update();

        return redirect('/profile/' . $userID . '/view');
    }


    public function store($userID, Request $request) {
        /*validate user input*/
        request()->validate([
            'birthday' => ['required', 'before:tomorrow'],
            'currCity' => ['required'],
            'fromCity' => ['required'],
            'bio' => ['required'],
            'gender' => ['required'],
            'ethnicity' => ['required'],
            'age' =>['required'],
            'profileImage' => ['required', 'file'],
            'bannerImage' => ['required', 'file']
        ]);


        /*insert into profiles table and get id*/
        \DB::beginTransaction();

        $bannerImage = $request->file('bannerImage');
        $bannerImage = Image::make($bannerImage->getRealPath());
        $bannerImage->resize(1115, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
        \Storage::disk('public')->put('images/'. $userID . '_bannerImg.jpg', $bannerImage);

        $profileImage = $request->file('profileImage');
        $profileImage = Image::make($profileImage->getRealPath());
        $profileImage->resize(100, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
        \Storage::disk('public')->put('images/' . $userID . '_profileImg.jpg', $profileImage);

        $demographics = Demographics::create([
            'profile_id' => \Auth::user()->profile->id,
            'birthday' => request('birthday'),
            'currentCity' => request('currCity'),
            'fromCity' => request('fromCity'),
            'bio' => request('bio'),
            'gender' => request('gender'),
            'race' => request('ethnicity'),
            'age' => request('age'),
            'profileImageLocation' => 'images/' . $userID . '_profileImg.jpg',
            'bannerImageLocation' => 'images/'. $userID . '_bannerImg.jpg'
        ]);



        if (!$demographics) {
            \DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to add demographics');
        }

        \DB::commit();


        return redirect('/profile/' . $userID . '/workHistory');
    }
}
