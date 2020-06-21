<?php
/*
    Project:
        Socialis: V1.0
    Module:
        Socialis: V1.0
    Author:
        David Pratt Jr.
    Date:
        6/14/2020
    Synopsis:
        Show user information


*/

?>
@extends('layouts.app')

@section('title', 'User')


@section('content')
    @if ($users->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Age</th>
                <th>User Since</th>
                <th>Admin?</th>
                <th>Active?</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < $demographics->count(); $i++)
                <tr>
                    <td>{{$users->get($i)->id}}</td>
                    <td>{{$users->get($i)->firstname . " " . $users->get($i)->lastname}}</td>
                    <td>{{$users->get($i)->username}}</td>
                    <td>{{$demographics->get($i)->age}}</td>
                    <td>{{$users->get($i)->created_at->format('m-d-Y H:i:s')}}</td>
                    <td>@if($users->get($i)->isAdmin) Yes @else No @endif</td>
                    <td>@if($users->get($i)->isActive) Yes @else No @endif</td>
                    <td>
                        @if($users->get($i)->isActive)
                        <form action="{{url('/users/suspend')}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="userID" value="{{$users->get($i)->id}}">
                            <input type="submit" class="btn btn-outline-warning" value="Suspend" >
                        </form>
                        @else
                        <form action="{{url('/users/reactivate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="userID" value="{{$users->get($i)->id}}">
                            <input type="submit" class="btn btn-outline-success" value="Reactivate">
                        </form>
                        @endif
                    </td>
                    <td>
                        @if ($users->get($i)->isAdmin)
                        <form action="{{url('/users/admin')}}" method="POST">
                            @csrf
                            <input type="hidden" name="userID" value="{{$users->get($i)->id}}">
                            <input type="submit" class="btn btn-outline-warning" value="No Admin">
                        </form>
                        @else
                        <form action="{{url('/users/admin')}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="userID" value="{{$users->get($i)->id}}">
                            <input  type="submit" class="btn btn-outline-success" value="To Admin">
                        </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{url('/users/delete')}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="userID" value="{{$users->get($i)->id}}">
                            <input type="submit" class="btn btn-outline-danger" value="Delete">
                        </form>
                    </td>
                    <td>
                        <a href="{{url('/profile/' . $users->get($i)->id . '/view')}}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
    @if ($demographics->count() < $users->count())
        <div class="d-flex justify-content-center">
            <h3 class="bg-warning">It looks like some users have not activated their accounts by creating profiles yet</h3>
        </div>
    @endif
    @else
        <div class="col bg-danger text-white d-flex justify-content-center">
            <h2>No Users Added yet</h2>
        </div>

    @endif
@endsection