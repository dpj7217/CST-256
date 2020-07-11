@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="listHeader">
        <h3>Job List</h3>
    </div>
    <table class="table">
        <!--
        --rows:
        ---- Company Image
        ---- Company Name
        ---- Job Listing Title
        ---- Department
        ---- Job Type
        ---- Job Starting Salary
        -->
        <tbody>
        @foreach($results as $job)
            <tr>
                <td><img src="{{$job->company->companyImageLocation}}" width="100" alt="{{$job->company->companyName}}'s image"></td>
                <td>{{$job->company->companyName}}</td>
                <td>{{$job->title}}</td>
                <td>{{$job->department}}</td>
                <td>${{$job->startingSalary}}</td>
                <td><?php switch ($job->jobType) {

                        case 1:
                            echo 'Intern';
                            break;
                        case 2:
                            echo 'Entry Level';
                            break;
                        case 3:
                            echo 'Experienced';
                            break;
                        case 4:
                            echo 'Senior';
                            break;
                        case 5:
                            echo 'C-Level';
                            break;

                    }?></td>

                @can('access')
                    <td>
                        <a href="{{url('/admin/jobs/' . $job->id . '/editJob')}}" class="btn btn-outline-primary">Edit</a>
                    </td>

                    <td>
                        <form id="deleteForm" action="{{url('/jobs/' . $job->id . '/delete')}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="jobID" value="{{$job->id}}">
                        </form>

                        <button id="deleteButton" class="btn btn-outline-danger">X</button>
                    </td>
                @else
                    <td><a href="{{url('/jobs/' . $job->id . '/view')}}" class="btn button">Details</a></td>
                @endcan
            </tr>
        </tbody>
    </table>
    @endforeach
    @can('access')
        <a href="{{url('/admin/jobs/add')}}" class="btn btn-primary">Add Job</a>
    @endcan

@endsection