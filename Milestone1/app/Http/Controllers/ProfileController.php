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
    public function create($userID) {
        if ($result = Profile::where('user_id', $userID)->first()) {
            return redirect('/profile/' . $userID . "/edit");
        }

        return view('createDemoInfo', [
            'userID' => $userID
        ]);
    }

    public function showWorkHistory($userID) {
        if (!(Profile::where('user_id', $userID))) {
            return redirect('/profile/' . $userID . '/create')->with('error', "Please submit demographic information before entering job history");
        }

        //if you've already submitted
        if (jobHistories::where('profile_id', function($query) use ($userID) {
            $query->select('id')->from('profiles')->where('user_id', $userID);
        })->first()) {
            return redirect('/profile/' . $userID . "/educationHistories");
        } else {
            return view('createWorkHistory', [
                'userID' => $userID
            ]);
        }
    }

    public function showEducationHistory($userID) {
       if (!(Profile::where('user_id', $userID))) {
           return redirect('/profile/' . $userID . "/create")->with('error', "Please submit demographic information before entering education history");
       }

       if (educationHistories::where('profile_id', function($query) use ($userID){
           $query->select('id')->from('profiles')->where('user_id', $userID);
       })->first()) {
           return redirect('/profile/' . $userID . '/view');
       } else {
           return view('createEducationHistory', [
               'userID' => $userID
           ]);
       }
    }

    public function show($userID) {
        return view('profile/profile', [
            'user' => User::find($userID),
            'profile' => User::where('id', $userID)->first()->profile,
            'demographics' => User::where('id', $userID)->first()->profile->demographics,
            'educationHistories' => User::where('id', $userID)->first()->profile->educationHistories->educationHistoriesDetails,
            'workHistory' => User::where('id', $userID)->first()->profile->jobHistories->jobHistoriesDetails,
            'groups' => User::where('id', $userID)->first()->groups,
            'userID' => $userID
        ]);
    }






    public function addDemographics($userID, Request $request) {
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


        $profile = Profile::create([
            'user_id' => request('userID')
        ]);

        if (!$profile) {
            \DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to add profile');
        }


        $demographics = Demographics::create([
            'profile_id' => $profile->id,
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





    public function addWorkHistory($userID) {
        if (request('numElements') < 1) {
            return redirect()->back()->with('error', 'At least one work history element required');
        }

        if (!(Profile::where('user_id', $userID)->first()))
            return redirect('/profile/' . $userID . "/create")->with('error', 'Please create a profile first');


        for($i = 1; $i <= request('numElements'); $i++) {
            $messages = [
                'companyName_' . $i . '.required' => "The 'Company Name' field is required",
                'from_' . $i . '.required' => "The 'From' field is required",
                'from_' . $i . '.before' => "The 'From' field must be before the 'To' field",
                'to_' . $i . '.required' => "The 'To' field is required",
                'to_' . $i . '.after' => "The 'To' field must be before the 'From' field",
                'description_' . $i . '.required' => "The 'Description' field is required",
                'role_' . $i . '.required' => "The 'Role' field is required"
            ];

            $validator = Validator::make(request()->all(), [
                'companyName_' . $i => ['required'],
                'from_' . $i => ['required', 'before:to_' . $i],
                'to_' . $i => ['required', 'after:from_' . $i],
                'description_' . $i => ['required'],
                'role_' . $i => ['required']
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('numElements', request('numElements'))->withErrors($validator);
            }
        }

        $jobHistory = jobHistories::create([
            'profile_id' => \Auth::user()->id
        ]);

        $isCurrent = 0;
        if (request('isCurrent'))
            $isCurrent = 1;


        for ($i = 1; $i <= request('numElements'); $i++) {
            $jobHistoryDetails = jobHistoriesDetails::create([
                'job_histories_id' => $jobHistory->id,
                'companyName' => request('companyName_' . $i),
                'from' => request('from_' . $i),
                'to' => request('to_' . $i),
                'description' => request('description_' . $i),
                'role' => request('role_' . $i),
                'current' => $isCurrent
            ]);
        }

        return redirect('/profile/' . $userID . '/educationHistories');
    }




    public function addEducationHistory($userID) {
        if (request('numElements') < 1) {
            return redirect()->back()->with('error', "At least one education element is required");
        }

        if (!(jobHistories::where('profile_id', function($query) use ($userID) {
            $query->select('id')->from('profiles')->where('user_id', $userID);
        })))
            return redirect('/profile/' . $userID . '/workHistory')->with('error', "You must submit job history before you submit education history");

        for($i = 1; $i <= request('numElements'); $i++) {
            $messages = [
                'institutionName_' . $i . ".required" => "The 'Institution Name' field is required",
                'from_' . $i . '.required' => "The 'From' field is required",
                'from_' . $i . '.before' => "The 'From' field must be before the 'To' field",
                'to_' . $i . '.required' => "The 'To' field is required",
                'to_' . $i . '.after' => "The 'To' field must be after the 'From' Field",
                'major_' . $i . '.required' => "The 'Major' field is required"
            ];

            $validator = Validator::make(request()->all(), [
                'institutionName_' . $i => ['required'],
                'from_' . $i => ['required', 'before:to_' . $i],
                'to_' . $i => ['required', 'after:from_' . $i],
                'major_' . $i => ['required']
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('numElements', request('numElements'))->withErrors($validator);
            }
        }

        $educationHistory = educationHistories::create([
            'profile_id' => Profile::where('user_id', $userID)->first()->id
        ]);

        for($i = 1; $i <= request('numElements'); $i++) {
            educationHistoriesDetails::create([
                'education_histories_id' => $educationHistory->id,
                'institutionName' => request('institutionName_' . $i),
                'from' => request('from_' . $i),
                'to' => request('to_' . $i),
                'major' => request('major_' . $i)
            ]);
        }

        return redirect('/profile/' . $userID . '/view');
    }
}
