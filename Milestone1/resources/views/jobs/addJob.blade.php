@extends('layouts.app')
@section('title', 'Add Job')


@section('head')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button
        {
            width: 45px;
            height: 30px;
            line-height: 1.65;
            float: left;
            display: block;
            margin: 0;
            padding-left: 20px;
            border: 1px solid #eee;
        }
    </style>
    <script>
        $(document).ready( function() {
            var current_section = $('#chooseExistingDiv');
            $('#addNewDiv').hide();

            $('#addNewBtn').on('click', function () {
                current_section.hide();
                current_section = $('#addNewDiv');
                $('#addNewDiv').show();
                $('#addNewInput').attr('value', 'true');
            });

            $('#chooseExistingBtn').on('click', function () {
                current_section.hide();
                current_section = $('#chooseExistingDiv');
                $('#chooseExistingDiv').show();
                $('#addNewInput').attr('value', '');
            });

        })
    </script>
@endsection


@section('content')

    <div style="margin-top: 15%;"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Job</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/admin/jobs/add') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="title" {{$errors->has('title') ? 'style=color:red' : ''}}>Listing Title</label>

                                <div class="col-md-8">
                                    <input type="text" class="{{$errors->has('title') ? 'border border-danger' : ''}} form-control" name="title" id="title" value="{{old('title')}}">

                                    @error('title')
                                        <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="department" {{$errors->has('department') ? 'style=color:red' : ''}}>Department</label>

                                <div class="col-md-8">
                                    <select class="{{$errors->has('department') ? 'border border-danger' : ''}} form-control" name="department" id="department">
                                        <option value="" disabled selected>Select</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Software Design">Software Design</option>
                                        <option value="Human Resources">Human Resources</option>
                                        <option value="Electrical Engineering">Electrical Engineering</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Art/Design">Art/Design</option>
                                    </select>

                                    @error('department')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="startingSalary" {{$errors->has('startingSalary') ? 'style=color:red' : ''}}>Starting Salary</label>

                                <div class="col-md-8">
                                    <input type="number" class="{{$errors->has('startingSalary') ? 'border border-danger' : ''}} form-control" name="startingSalary" id="startingSalary" min="50000" max="150000" step="5000" placeholder="50000">

                                    @error('startingSalary')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="description" {{$errors->has('description') ? 'style=color:red' : ''}}>Description</label>

                                <div class="col-md-8">
                                    <textarea class="{{$errors->has('description') ? 'border border-danger' : ''}} form-control" rows="10" name="description" id="description">{{old('description')}}</textarea>

                                    @error('description')
                                        <p style="color: red">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="jobType" {{$errors->has('jobType') ? 'style=color:red' : ''}}>Job Type</label>

                                <div class="col-md-8">
                                    <select class="{{$errors->has('jobType') ? 'border border-danger' : ''}} form-control" name="jobType" id="jobType">
                                        <option value="" disabled selected>Select</option>
                                        <option value="1">Intern</option>
                                        <option value="2">Entry Level</option>
                                        <option value="3">Experienced</option>
                                        <option value="4">Senior</option>
                                        <option value="5">C-Level</option>
                                    </select>

                                    @error('jobType')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="yearsExperience" {{$errors->has('yearsExperience') ? 'style=color:red' : ''}}>Experience Necessary</label>

                                <div class="col-md-8">
                                    <select class="{{$errors->has('yearsExperience') ? 'border border-danger' : ''}}  form-control" name="yearsExperience" id="yearsExperience">
                                        <option value="" selected disabled>Select</option>
                                        <option value="0"> < 1 Year </option>
                                        <option value="1">1 Years</option>
                                        <option value="2">2 Years</option>
                                        <option value="3">3 Years</option>
                                        <option value="4">4 Years</option>
                                        <option value="5">5 Years</option>
                                        <option value="6">6 Years</option>
                                        <option value="7">7 Years</option>
                                        <option value="8">8 Years</option>
                                        <option value="9">9 Years</option>
                                        <option value="10">10 Years</option>
                                        <option value="11">10+ Years</option>
                                    </select>

                                    @if($errors->has('yearsExperience'))
                                        <p style="color: red">{{$errors->first('yearsExperience')}}</p>
                                    @else
                                        <small class="form-text text-muted">This field is NOT required</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="degreeNeeded" {{$errors->has('degreeNeeded') ? 'style=color:red' : ''}}>Degree Necessary</label>
                                <div class="col-md-8">
                                    <select class="{{$errors->has('degreeNeeded') ? 'border border-danger' : ''}} form-control" name="degreeNeeded" id="degreeNeeded">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1">GED</option>
                                        <option value="2">High School Diploma</option>
                                        <option value="3">Some College</option>
                                        <option value="4">Bachelors</option>
                                        <option value="5">Masters</option>
                                        <option value="6">Doctorate</option>
                                    </select>

                                    @if($errors->has('degreeNeeded'))
                                        <p style="color: red">{{$errors->first('degreeNeeded')}}</p>
                                    @else
                                        <small class="form-text text-muted">This field is NOT required</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="otherRequirements">Other Requirements</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" name="otherRequirements" id="otherRequirements" rows="3"></textarea>
                                    <small class="form-text text-muted">This field is NOT required</small>
                                </div>
                            </div>






                            {{--fist have to see if there are any companies in database--}}
                            @if (\App\Company::latest()->count())
                                {{--choice for whether to select existing company or to add new company--}}

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="companyName"></label>

                                    <div class="col-md-8" style="border: 1px solid black">
                                        <div class="my-3 d-flex justify-content-center">
                                            <button type="button" class="btn button" style="margin-right: .5rem!important;" id="addNewBtn">Add New Company</button>
                                            <button type="button" class="btn button mx-2" id="chooseExistingBtn">Choose Existing Company</button>
                                        </div>




                                        {{--if choice is addnew--}}
                                            {{--input for company name && hidden input for createNewCompanyName && input for company logo--}}
                                        <div id="addNewDiv">
                                            <input type="hidden" name="addNewCompany" id="addNewInput" value="">

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="companyName">Company Name</label>

                                                <div class="col-md-8">
                                                    <input type="text" name="companyName" id="companyName" class="form-control">

                                                    @error('companyName')
                                                    <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="companyLogo">Company Logo</label>

                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="companyLogo" id="companyLogo">

                                                    @error('companyLogo')
                                                    <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>



                                        {{--if choice is select existing--}}
                                        {{--select for company name && display for company logo--}}
                                        <div id="chooseExistingDiv">
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="company">Choose Company</label>

                                                <div class="col-md-8">
                                                    <select name="company" id="company" class="form-control">
                                                        <option value="" disabled selected>Select</option>
                                                        <?php $companies = \App\Company::latest()->get() ?>
                                                        @foreach($companies as $company)
                                                            <option value="{{ $company->id }}">{{$company->companyName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else

                                <input type="hidden" name="addNewCompany" value="true">
                                {{--input for new company name && input for new company logo--}}
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="companyName">Company Name</label>

                                    <div class="col-md-8">
                                        <input type="text" name="companyName" id="companyName" class="form-control">

                                        @error('companyName')
                                        <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="companyLogo">Company Logo</label>

                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="companyLogo" id="companyLogo">

                                        @error('companyLogo')
                                        <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            @endif






                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="isRemote" id="isRemote" {{ old('isRemote') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="isRemote">Is this job remote?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection