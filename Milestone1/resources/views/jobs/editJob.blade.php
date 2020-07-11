@extends('layouts.app')

@section('title', $job->title)

@section('head')
    <script>
        $(document).ready(function() {
            $('#department option[value="{{$job->department}}"]').attr('selected', 'true');
            $('#jobType option[value="{{$job->jobType}}"').attr('selected', 'true');
            $('#yearsExperience option[value="{{$job->yearsExperience}}"]').attr('selected', 'true');
            $('#degreeNeeded option[value="{{$job->degreeNeeded}}"]').attr('selected', 'true');

        })
    </script>
@endsection

@section('content')
    <div style="margin-top: 30px"></div>
    <h3>Job Details</h3>
    <form action="{{url('admin/jobs/'. $job->id . '/edit')}}" method="POST">
        @csrf
        @method('patch')

        <div class="form-row">
            <div class="form-group col">
                <label for="title" {{$errors->has('title') ? 'style=color:red' : ''}}>Title</label>
                <input type="text" class="{{$errors->has('title') ? 'border border-danger' : ''}} form-control" name="title" id="title" value="{{$job->title}}">
                @if($errors->has('title'))
                    <p style="color: red">{{$errors->first('title')}}</p>
                @endif
            </div>
        </div>



        <div class="form-row">

            <div class="form-group col-6">
                <label for="department" {{$errors->has('department') ? 'style=color:red' : ''}}>Department</label>
                <select class="{{$errors->has('department') ? 'border border-danger' : ''}} form-control" name="department" id="department">
                    <option value="" disabled selected>Select</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Software Design">Software Design</option>
                    <option value="Human Resources">Human Resources</option>
                    <option value="Electrical Engineering">Electrical Engineering</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Art/Design">Art/Design</option>
                </select>
                @if($errors->has('department'))
                    <p style="color: red">{{$errors->first('department')}}</p>
                @endif

            </div>

            <div class="form-group col-6">
                <label for="startingSalary" {{$errors->has('startingSalary') ? 'style=color:red' : ''}}>Starting Salary</label>
                <input type="number" class="{{$errors->has('startingSalary') ? 'border border-danger' : ''}} form-control"
                       name="startingSalary"
                       id="startingSalary"
                       min="50000"
                       max="150000"
                       step="5000"
                       value="{{$job->startingSalary}}">
                @if($errors->has('startingSalary'))
                    <p style="color: red">{{$errors->first('startingSalary')}}</p>
                @endif
            </div>

        </div>



        <div class="form-row">
            <div class="form-group col">
                <label for="description" {{$errors->has('description') ? 'style=color:red' : ''}}>Description</label>
                <textarea class="{{$errors->has('description') ? 'border border-danger' : ''}} form-control" rows="10" name="description" id="description">{{$job->description}}</textarea>
                @if($errors->has('description'))
                    <p style="color: red">{{$errors->first('description')}}</p>
                @endif
            </div>
        </div>



        <div class="form-row">

            <div class="form-group col-4">
                <label for="jobType" {{$errors->has('jobType') ? 'style=color:red' : ''}}>Job Type</label>
                <select class="{{$errors->has('jobType') ? 'border border-danger' : ''}} form-control" name="jobType" id="jobType">
                    <option value="" disabled selected>Select</option>
                    <option value="1">Intern</option>
                    <option value="2">Entry Level</option>
                    <option value="3">Experienced</option>
                    <option value="4">Senior</option>
                    <option value="5">C-Level</option>
                </select>
                @if($errors->has('jobType'))
                    <p style="color: red">{{$errors->first('jobType')}}</p>
                @endif
            </div>

            <div class="form-group col-4">
                <label for="yearsExperience" {{$errors->has('yearsExperience') ? 'style=color:red' : ''}}>Experience Necessary</label>
                <select class="{{$errors->has('yearsExperience') ? 'border border-danger' : ''}}  form-control" name="yearsExperience" id="yearsExperience">
                    <option value="" selected disabled>Select</option>
                    <option value="0"> < 1 </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">10+</option>
                </select>
                @if($errors->has('yearsExperience'))
                    <p style="color: red">{{$errors->first('yearsExperience')}}</p>
                @else
                    <small class="form-text text-muted">This field is NOT required</small>
                @endif
            </div>

            <div class="form-group col-4">
                <label for="degreeNeeded" {{$errors->has('degreeNeeded') ? 'style=color:red' : ''}}>Degree Necessary</label>
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



        <div class="form-row">
            <div class="form-group col">
                <label for="otherRequirements">Other Requirements</label>
                <textarea class="form-control" name="otherRequirements" id="otherRequirements" rows="3">{{$job->otherRequirements}}</textarea>
                <small class="form-text text-muted">This field is NOT required</small>
            </div>
        </div>



        <div class="form-row">
            <div class="form-check">
                <input type="checkbox" class="form-input-check" name="isRemote" id="isRemote" {{$job->isRemote ? 'checked' : ''}}>
                <label for="isRemote">Job is remote</label>
            </div>
        </div>


        <div style="margin-top: 3%;">
            <input type="submit" value="Submit Edits" class="btn btn-primary">
            <a href="{{url('/admin/jobs')}}" class="btn btn-secondary">Back To Job List</a>
        </div>
    </form>
@endsection
