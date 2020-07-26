<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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


class WorkHistoryController extends Controller
{
    /*profile/{userID}/workHistory*/
    public function show($userID) {
        if (!(\Auth::user()->profile->demographics)) {
            return redirect('/profile/' . $userID . '/create')->with('error', "Please submit demographic information before entering job history");
        }

        //if you've already submitted
        if (\Auth::user()->profile->jobHistories) {
            return redirect('/profile/' . $userID . "/educationHistories");
        } else {
            return view('createWorkHistory', [
                'userID' => $userID
            ]);
        }
    }

    public function store($userID) {
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
            'profile_id' => \Auth::user()->profile->id
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

    public function edit($userID) {

        if (request('numElements') < 1)
            return redirect()->back();


        $workHistories = \Auth::user()->profile->jobHistories->jobHistoriesDetails;

        if (request('numElements') * 1 !== $workHistories->count()) {
            return redirect()->back()->with('error', 'Problem processing request');
        }

        //validate request
        for($i = 1; $i <= request('numElements'); $i++) {

            request()->validate(
            //rules
                [
                    'companyName_' . $i => ['required'],
                    'role_' . $i => ['required'],
                    'description_' . $i => ['required'],
                    'from_' . $i => ['required', 'before:to_' . $i],
                    'to_' . $i => ['required', 'after:from_' . $i]
                ],
                //messages
                [
                    'companyName_' . $i . '.required' => "The 'Company Name' field is required",
                    'role_' . $i . '.required' => "The 'Role' field is required",
                    'from_' . $i . '.required' => "The 'Started' field must have a valid date",
                    'description_' . $i . '.required' => "The 'Description' field is required",
                    'from_' . $i . '.before' => "The 'Started' field must come after the 'Finished' field",
                    'to_' . $i . '.required' => "The 'Finished' field is required. If this is a current position, put today's date",
                    'to_' . $i . '.after' => "The 'Finished' field must come after the 'Started' field"
                ]
            );
            //get specific work History
            $jobHistoriesDetails = jobHistoriesDetails::find(request('workIDAt_' . $i));

            //update work History
            $jobHistoriesDetails->companyName = request('companyName_' . $i);
            $jobHistoriesDetails->role = request('role_' . $i);
            $jobHistoriesDetails->description = request('description_' . $i);
            $jobHistoriesDetails->from = request('from_' . $i);
            $jobHistoriesDetails->to = request('to_' . $i);

            $jobHistoriesDetails->update();
        }

        return redirect('/profile/' . $userID . '/view');

    }
}
