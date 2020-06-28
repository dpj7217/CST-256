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
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Starting Salary</th>
                <th>See Details</th>
                <th><!-- Delete column--></th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $job)
                <tr>
                    <td>{{$job->id}}</td>
                    <td>{{$job->title}}</td>
                    <td>{{$job->description}}</td>
                    <td>{{$job->startingSalary}}</td>
                    <td>
                        <a href="{{url('/jobs/' . $job->id . '/view')}}" class="btn btn-outline-primary">Details</a>
                    </td>
                    <td>
                        <form id="deleteForm" action="{{url('/jobs/' . $job->id . '/delete')}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="jobID" value="{{$job->id}}">
                        </form>

                        <button id="deleteButton" class="btn btn-outline-danger">X</button>
                    </td>
                </tr>
            @empty
                <h3 id="missingJobs">Looks like you don't have any jobs yet, add one to see it here</h3>
            @endforelse
        </tbody>
    </table>
    <a href="{{url('/admin/jobs/add')}}" class="btn btn-primary">Add Job</a>
@endsection

