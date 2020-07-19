@extends('layouts.app')

@section('title', 'Job Postings')

@section('head')
    <style>
        #missingJobs {
            padding: 5px;
            width: 100%;
            background-color: red;
            color: white;
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#deleteButton').on('click', function() {
                var conf = confirm('Are you sure that you want to delete this job?');
                if (conf) {
                    $('#deleteForm').submit();
                }
            })
        })
    </script>
@endsection

@section('content')

    <div class="listHeader">
        <h3>Job List</h3>
        <div class="searchDiv">
            <form action="{{url('/jobs/search')}}" method="GET" class="form-inline">
                <div class="form-group row">
                    <label class="form-label " for="q">Search</label>
                    <div class="col-md-4">
                        <input type="text" name="q" class="form-control mx-sm-2" id="q" placeholder="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $noResults = session('noResults')?>
    @if($noResults)
        <p style="float:right; width: 100%; color: red; text-align: right; margin-right: 15px;">{{ $noResults }}</p>
    @endif
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
            @forelse($jobs as $job)
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
            @empty
                <h3 id="missingJobs">No one is hiring right now. Come back later and try again</h3>
            @endforelse
        </tbody>
    </table>
    @can('access')
        <a href="{{url('/admin/jobs/add')}}" class="btn btn-primary">Add Job</a>
    @endcan
@endsection

