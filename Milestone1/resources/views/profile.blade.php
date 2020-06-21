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
    <div style="margin-top: 30px">
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
    </div>


    <div class="row">


        <div class="col-4">

        </div>

    </div>
    @endif
@endsection
