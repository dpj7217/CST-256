<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\user;
use \App\Profile;
use \App\Demographics;
use \App\jobHistories;
use \App\jobHistoriesDetails;
use \App\educationHistory;
use \App\educationHistoriesDetails;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ProfileController extends Controller
{
    public function create($userID) {
        if ($result = Profile::where('userID', $userID)->first()) {
            return redirect('/profile/' . $userID . "/edit");
        }

        return view('createDemoInfo', [
            'userID' => $userID
        ]);
    }

    public function showWorkHistory($userID) {
        if (!(Profile::where('userID', $userID))) {
            return redirect('/profile/' . $userID . '/create')->with('error', "Please submit demographic information before entering job history");
        }

        //if you've already submitted
        if (jobHistories::where('profileID', function($query) use ($userID) {
            $query->select('id')->from('profiles')->where('userID', $userID);
        })->first()) {
            return redirect('/profile/' . $userID . "/educationHistory");
        } else {
            return view('createWorkHistory', [
                'userID' => $userID
            ]);
        }
    }

    public function showEducationHistory($userID) {
       if (!(Profile::where('userID', $userID))) {
           return redirect('/profile/' . $userID . "/create")->with('error', "Please submit demographic information before entering education history");
       }

       if (educationHistory::where('profileID', function($query) use ($userID){
           $query->select('id')->from('profiles')->where('userID', $userID);
       })->first()) {
           return redirect('/profile/' . $userID . '/view');
       } else {
           return view('createEducationHistory', [
               'userID' => $userID
           ]);
       }
    }

    public function show($userID) {
        return view('profile', [
            'user' => User::find($userID),
            'profile' => Profile::where('userID', $userID)->first(),
            'demographics' => \App\Demographics::where('profileID', function($query) use ($userID) {
                $query->select('id')->from('profiles')->where('userID', $userID);
            })->first(),
            'educationHistory' => educationHistoriesDetails::where('educationHistoryID', function($query) use ($userID) {
                $query->select('id')->from('education_histories')->where('profileID', function($query) use ($userID) {
                    $query->select('id')->from('profiles')->where('userID', $userID);
                });
            })->get(),
            'workHistory' => jobHistoriesDetails::where('jobHistoryID', function($query) use ($userID) {
                $query->select('id')->from('job_histories')->where('profileID', function($query) use ($userID){
                   $query->select('id')->from('profiles')->where('userID', $userID);
                });
            })->get()
        ]);
    }






    public function addDemographics($userID) {
        /*validate user input*/
        request()->validate([
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


        return redirect('/profile/' . $userID . '/workHistory');
    }





    public function addWorkHistory($userID, Request $request) {
        if (request('numElements') < 1) {
            return redirect()->back()->with('error', 'At least one work history element required');
        }

        if (!(Profile::where('userID', $userID)->first()))
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
            'profileID' => Profile::where('userID', $userID)->first()->id
        ]);

        $isCurrent = 0;
        if (request('isCurrent'))
            $isCurrent = 1;


        for ($i = 1; $i <= request('numElements'); $i++) {
            $jobHistoryDetails = jobHistoriesDetails::create([
                'jobHistoryID' => $jobHistory->id,
                'companyName' => request('companyName_' . $i),
                'from' => request('from_' . $i),
                'to' => request('to_' . $i),
                'description' => request('description_' . $i),
                'role' => request('role_' . $i),
                'current' => $isCurrent
            ]);
        }

        return redirect('/profile/' . $userID . '/educationHistory');
    }

    public function addEducationHistory($userID) {
        if (request('numElements') < 1) {
            return redirect()->back()->with('error', "At least one education element is required");
        }

        if (!(jobHistories::where('profileID', function($query) use ($userID) {
            $query->select('id')->from('profiles')->where('userID', $userID);
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

        $educationHistory = educationHistory::create([
            'profileID' => Profile::where('userID', $userID)->first()->id
        ]);

        for($i = 1; $i <= request('numElements'); $i++) {
            educationHistoriesDetails::create([
                'educationHistoryID' => $educationHistory->id,
                'institutionName' => request('institutionName_' . $i),
                'from' => request('from_' . $i),
                'to' => request('to_' . $i),
                'major' => request('major_' . $i)
            ]);
        }

        return redirect('/profile/' . $userID . '/view');
    }
}
