<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\job;

class jobsController extends Controller
{
    public function show(){
        return view('jobList', [
            'jobs' => job::latest()->get()
        ]);
    }

    public function showAdd() {
        return view('addJob');
    }

    public function showJob($jobID) {
        return view('jobDetails', [
            'job' => job::find($jobID)
        ]);
    }


    public function addJob() {
        request()->validate(
            //fields
            [
            'title' => ['required'],
            'department' => ['required'],
            'startingSalary' => ['required'],
            'description' => ['required'],
            'jobType' => ['required', 'min:1', 'max:5'],
            'yearsExperience' => ['min:0', 'max:11'],
            'degreeNeeded' => ['min:1', 'max:6'],
            ],
            //messages
            [
                'title.required' => "The 'Title' field is required",
                'department.required' => "The 'Department' field is required",
                'startingSalary.required' => "The 'Salary' field is required",
                'description.required' => "The 'Description' field is required",
                'jobType.required' => "The 'Job Type' field is required",
                'jobType.min' => "Please select from the provided fields",
                'jobType.max' => "Please select from the provided fields",
                'yearsExperience.min' => "Please select from the provided fields",
                'yearsExperience.max' => "Please select from the provided fields",
                'degreeNeeded.min' => "Please select from the provided fields",
                'degreeNeeded.max' => "Please select from the provided fields",
            ]
        );

        $isRemote = null;

        if (request('isRemote')) {
            $isRemote = 1;
        }

        job::create([
           'title' => request('title'),
           'department' => request('department'),
           'startingSalary' => request('startingSalary'),
           'description' => request('description'),
           'jobType' => request('jobType'),
           'yearsExperience' => request('yearsExperience'),
           'degreeNeeded' => request('degreeNeeded'),
           'otherRequirements' => request('otherRequirements'),
           'isRemote' => $isRemote
        ]);

        return redirect('/admin/jobs');
    }

    public function editJob($jobID) {
        request()->validate(
        //fields
            [
                'title' => ['required'],
                'department' => ['required'],
                'startingSalary' => ['required'],
                'description' => ['required'],
                'jobType' => ['required', 'min:1', 'max:5'],
                'yearsExperience' => ['min:0', 'max:11'],
                'degreeNeeded' => ['min:1', 'max:6'],
            ],
            //messages
            [
                'title.required' => "The 'Title' field is required",
                'department.required' => "The 'Department' field is required",
                'startingSalary.required' => "The 'Salary' field is required",
                'description.required' => "The 'Description' field is required",
                'jobType.required' => "The 'Job Type' field is required",
                'jobType.min' => "Please select from the provided fields",
                'jobType.max' => "Please select from the provided fields",
                'yearsExperience.min' => "Please select from the provided fields",
                'yearsExperience.max' => "Please select from the provided fields",
                'degreeNeeded.min' => "Please select from the provided fields",
                'degreeNeeded.max' => "Please select from the provided fields",
            ]
        );

        $isRemote = null;
        if (request('isRemote')){
            $isRemote = 1;
        }

        $job = job::find($jobID);

        $job->title = request('title');
        $job->department = request('department');
        $job->startingSalary = request('startingSalary');
        $job->description = request('description');
        $job->jobType = request('jobType');
        $job->yearsExperience = request('yearsExperience');
        $job->degreeNeeded = request('degreeNeeded');
        $job->otherRequirements = request('otherRequirements');
        $job->isRemote = $isRemote;

        $job->save();

        return redirect('/admin/jobs');
    }

    public function deleteJob($jobID) {
        $job = job::find($jobID);

        $job->delete();

        return redirect('/admin/jobs');
    }
}
