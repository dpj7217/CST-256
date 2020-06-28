<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 6/19/2020
 * Time: 2:56 PM
 */
?>
@extends('layouts.app')
@section('title', 'My Profile')

@section('head')
    <style>
        .profilePicture {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            border-radius: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .information {
            font-family: Calibri;
            font-size: 24px;
            font-weight: bold;
            border: 2px dashed blue;
            padding: 5px;
            height: 50px;
            color: #2b2828;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .userInfo div {
            display: inline-block;
        }

        .userInfo {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background-color: lightgrey;
            border-radius: 25px;
        }

        .userInfo h3 {
            margin: 10px;
        }

        .row div {
            margin: 10px;
        }

        #bio {
            background-color: #e6e6e6;
            display: flex;
            justify-content: left;
            text-align: center;
            font-family: Arial;
            font-size: 20px;
            outline: 3px dashed #0062ff;
            outline-offset: -5px;
            padding: 8px;
            border-radius: 25px;
        }

        .center {
            display: flex;
            justify-content: space-around;
        }
    </style>

@endsection


@section('content')
    <div style="margin-top: 30px"></div>
        <div class="row">
        @if (!$profile)
            <div>
                <h5>Looks like you haven't finished your profile yet.</h5>
                <a href="{{url('/profile/' . $user->id . '/create')}}" class="btn btn-primary">Create One</a>
            </div>

        @else
            <div class="profilePicture">
                <img src="/Milestone1/public/storage/{{$demographics->profileImageLocation}}" alt="{{$user->username}}'s profile picture">
            </div>


            <div class="form-row col userInfo" >

                <div>
                    <h3>Name</h3>
                    <p class="information">{{$user->firstname . " " . $user->lastname}}</p>
                </div>

                <div>
                    <h3>Screen Name</h3>
                    <p class="information">{{$user->username}}</p>
                </div>

                <div>
                    <h3>Age</h3>
                    <p class="information">{{$demographics->age}}</p>
                </div>

                <div>
                    <h3></h3>
                </div>

            </div>

        </div>

        <div class="row">

            <div id="bio" class="col">
                <p>{{$demographics->bio}}</p>
            </div>

        </div>


        <div class="row center">

            <div class="col-1"></div>

            <div class="col-4">
                <h3>From</h3>
                <p>{{$demographics->fromCity}}</p>
            </div>

            <div class="col-4">
                <h3>Resides In</h3>
                <p>{{$demographics->currentCity}}</p>
            </div>

        </div>


        <div class="row center">

            <div class="col-1"></div>

            <div class="col-4">
                <h3>Identifies as</h3>
                <p>{{$demographics->gender}}</p>
            </div>

            <div class="col-4">
                <h3>Birthday</h3>
                <p>{{$demographics->birthday}}</p>
            </div>
        </div>
    @endif

    <h3>Work History</h3>
    @forelse($workHistory as $job)
        <div class="form-row">
            <div class="form-group col">
                <label for="companyName">Company Name</label>
                <input type="text" class="form-control" id="companyName" value="{{$job->companyName}}" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="from">From</label>
                <input type="date" id="from" class="form-control" value="{{$job->from}}" disabled>
            </div>
            <div class="form-group col-6">
                <label for="to">To</label>
                <input type="date" id="to" class="form-control" value="{{$job->to}}" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" rows="6" disabled>{{$job->description}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-check">
                <input type="checkbox" id="isCurrent" class="form-check-input" {{$job->isCurrent ? 'checked' : ''}}>
                <label class="form-check-label" for="isCurrent">I Currently Work Here</label>
            </div>
        </div>
        <br><br>
    @empty
        <div>
            <h5>Looks like you haven't finished your work history yet</h5>
            <a href="{{url('/profile/' . $user->id . '/workHistory')}}">Add work History</a>
        </div>
    @endforelse

    <h3>Education History</h3>
    @forelse($educationHistory as $education)
        <div class="form-row">
            <div class="form-group col">
                <label for="institutionName">Institution Name</label>
                <input type="text" id="institutionName" class="form-control" value="{{$education->institutionName}}" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="from">From</label>
                <input type="date" id="from" class="form-control" value="{{$education->from}}" disabled>
            </div>
            <div class="form-group col-6">
                <label for="to">To</label>
                <input type="date" class="form-control" id="to" value="{{$education->to}}" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="major">Major</label>
                <input type="text" id="major" class="form-control" value="{{$education->major}}" disabled>
            </div>
        </div>
    @empty
        <h5>Looks like you haven't finished your education history yet</h5>
        <a href="{{url('/profile/' . $user->id . '/educationHistory')}}">Add education history</a>
    @endforelse
@endsection
