<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use Intervention\Image\ImageManagerStatic as Image;
use \App\job;
use \App\Company;
use \App\Application;

class jobsController extends Controller
{
    public function show(){
        return view('jobs/jobList', [
            'jobs' => job::latest()->get()
        ]);
    }

    public function showAdd() {
        return view('jobs/addJob');
    }

    /*/jobs/{jobID}/view*/
    public function showJob($jobID) {
        return view('jobs/jobDetails', [
            'job' => job::find($jobID)
        ]);
    }

    /*/admin/jobs/{jobID}/edit*/
    public function showEditJob($jobID) {
        return view('jobs/editJob', [
            'job' => job::find($jobID)
        ]);
    }

    public function showSearchResults() {
        return view('jobs/searchResults');
    }


    public function addJob(Request $request) {
        /*if user added a new company*/
        if (request('addNewCompany')) {




            /*Validate Request*/
            request()->validate(
                //rules
                [
                    'title' => ['required'],
                    'department' => ['required'],
                    'startingSalary' => ['required'],
                    'description' => ['required'],
                    'jobType' => ['required', 'min:1', 'max:5'],
                    'yearsExperience' => ['min:0', 'max:11'],
                    'degreeNeeded' => ['min:1', 'max:6'],
                    'companyName' => ['required', 'max:255'],
                    'companyLogo' => ['required']
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
                    'companyName.required' => "The 'Company Name' field is required",
                    'companyName.max' => "The 'Company Name' field can only have 266 characters",
                    'companyLogo.required' => "The 'Company Image' field is required"
                ]);


            /*get file's name*/
            $nameArr = explode(' ', request('companyName'));
            $filename = "";
            foreach($nameArr as $part)
                $filename = $filename . '_' . $part;


            /*if image isn't in storage already, add it*/
            if (!(\Storage::disk('public')->exists($filename))){
                $companyImage = $request->file('companyLogo');

                $companyImage = Image::make($companyImage->getRealPath());
                $companyImage->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg', 100);
                \Storage::disk('public')->put('images/companies/' . $filename . '_img.jpg', $companyImage);
            }


            /*create the company in db*/
            $company = Company::create([
                'companyName' => request('companyName'),
                'companyImageLocation' => 'images/companies/' . $filename . '_img.jpg'
            ]);


            /*set request flag*/
            $isRemote = null;
            if (request('isRemote')) {
                $isRemote = 1;
            }

            /*create job in db*/
            job::create([
                'title' => request('title'),
                'department' => request('department'),
                'user_id' => \Auth::user()->id,
                'company_id' => $company->id,
                'startingSalary' => request('startingSalary'),
                'description' => request('description'),
                'jobType' => request('jobType'),
                'yearsExperience' => request('yearsExperience'),
                'degreeNeeded' => request('degreeNeeded'),
                'otherRequirements' => request('otherRequirements'),
                'isRemote' => $isRemote
            ]);




        /*otherwise if user used existing company*/
        } else {



            /*validate request*/
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
                    'company' => ['required', 'exists:companies,id']
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
                    'company.required' => "The 'Company' field is required",
                    'company.exists' => "The 'Company' that you supplied doesn't exist."
                ]
            );


            /*set remote flag*/
            $isRemote = null;
            if (request('isRemote')) {
                $isRemote = 1;
            }

            /*create job*/
            job::create([
                'title' => request('title'),
                'department' => request('department'),
                'user_id' => \Auth::user()->id,
                'company_id' => request('company'),
                'startingSalary' => request('startingSalary'),
                'description' => request('description'),
                'jobType' => request('jobType'),
                'yearsExperience' => request('yearsExperience'),
                'degreeNeeded' => request('degreeNeeded'),
                'otherRequirements' => request('otherRequirements'),
                'isRemote' => $isRemote
            ]);
        }



        return redirect('/jobs');

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


    public function apply($jobID) {
        request()->validate(
        //fields
            [
                'title' => ['required', 'exists:jobs,title'],
                'department' => ['required', 'exists:jobs,department'],
                'startingSalary' => ['required'],
                'description' => ['required'],
                'jobType' => ['required', 'min:1', 'max:5', 'exists:jobs,jobType'],
                'yearsExperience' => ['min:0', 'max:11'],
                'degreeNeeded' => ['min:1', 'max:6']
            ],
            //messages
            [
                'title.required' => "The 'Title' field is required",
                'title.exists' => "The 'Title' that you supplied doesn't exist",
                'department.required' => "The 'Department' field is required",
                'department.exists' => "The 'Department' that you supplied doesn't exist.",
                'startingSalary.required' => "The 'Salary' field is required",
                'description.required' => "The 'Description' field is required",
                'jobType.required' => "The 'Job Type' field is required",
                'jobType.min' => "Please select from the provided fields",
                'jobType.max' => "Please select from the provided fields",
                'jobType.exists' => "The 'Job Type' that you supplied doesn't exist/].",
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
        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => \Auth::user()->id
        ]);

        return redirect('/profile/' . \Auth::user()->id . '/view');

    }

    public function search() {
        $results = job::where('id', 'like', '%' . request('q') . '%')
                    ->orWhere('title', 'like', '%' . request('q') . '%')
                    ->orWhere('company_id', 'like', '%' . request('q') . '%')->get();

        if ($results->count())
            return view('jobs/searchResults', [
                'results' => $results
            ]);
        else
            return redirect()->back()->with('noResults', "Nothing found that matches '" . request('q') . "'");
    }

    public function deleteJob($jobID) {
        $job = job::find($jobID);

        $job->delete();

        return redirect('/admin/jobs');
    }
}
