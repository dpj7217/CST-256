<?php

namespace App\Http\Controllers;

use \App\user;
use \App\Profile;
use \App\Demographics;
use \App\jobHistories;
use \App\jobHistoriesDetails;
use \App\educationHistories;
use \App\educationHistoriesDetails;
use Illuminate\Support\Facades\Validator;
class EducationHistoryController extends Controller
{
    /*/profile/{userID}/educationHistories*/
    public function show($userID) {
        if (!(\Auth::user()->profile->demographics)) {
            return redirect('/profile/' . $userID . "/create")->with('error', "Please submit demographic information before entering education history");
        }

        if ( \Auth::user()->profile->educationHistories) {
            return redirect('/profile/' . $userID . '/view');
        } else {
            return view('createEducationHistory', [
                'userID' => $userID
            ]);
        }
    }


    public function store($userID) {
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

    public function edit($userID) {

        if (request('numElements') < 1)
            return redirect()->back();


        $educationHistories = \Auth::user()->profile->educationHistories->educationHistoriesDetails;

        if (request('numElements') * 1 !== $educationHistories->count()) {
            return redirect()->back()->with('error', 'Problem processing request');
        }

        //validate request
        for($i = 1; $i <= request('numElements'); $i++) {

            request()->validate(
                //rules
                [
                    'schoolIDAt' . $i => ['required'],
                    'institutionName_' . $i => ['required', 'max:255'],
                    'major_' . $i => ['required'],
                    'from_' . $i => ['required', 'before:to_' . $i],
                    'to_' . $i => ['required', 'after:from_' . $i],
                ],
                //messages
                [
                    'schoolIDAt' . $i . '.required' => "You must have a valid amount",
                    'schoolIDAt' . $i . '.exists' => "This school does not exist in our database. Please try again",
                    'institutionName_' . $i . '.required' => "The 'Institution Name' Field must be filled out",
                    'institutionName_' . $i . '.max' => "This name is too long to be accepted. If you have to, use abbreviation",
                    'major_' . $i . '.required' => "The 'Major' field is required",
                    'from_' . $i . '.required' => "The 'Started' field must have a valid value",
                    'from_' . $i . '.before' => "The 'Started' field must be before the 'Finished' field",
                    'to_' . $i . '.required' => "The 'Finished' field must have a valid value",
                    'to_' . $i . '.after' => "The 'Finished' field must be after the 'Started' field"
                ]
            );
            //get specific education History
            $educationHistoriesDetails = educationHistoriesDetails::find(request('schoolIDAt' . $i));

            //update education History
            $educationHistoriesDetails->institutionName = request('institutionName_' . $i);
            $educationHistoriesDetails->major = request('major_' . $i);
            $educationHistoriesDetails->from = request('from_' . $i);
            $educationHistoriesDetails->to = request('to_' . $i);

            $educationHistoriesDetails->update();
        }

        return redirect('/profile/' . $userID . '/view');
    }
}
