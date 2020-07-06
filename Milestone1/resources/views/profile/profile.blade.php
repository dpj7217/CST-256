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
        .banner {
            width: inherit;
            height: 45%;
            overflow: hidden;
            border-bottom: 3px solid black;
        }

        .profile {
            height: 250px;
            width: 250px;
            border-radius: 250px;
            border: 1px solid black;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: auto;
            position: absolute;
            background-color: white;
            left: 45%;
            top: 30%;
            z-index: 3;
        }

        .profileNavBar {
            width: inherit;
            display: flex;
            justify-content: center;
            background-color: #0f3b0f;
            color: white;
            font-family: "Lucida Sans", "monospace", sans-serif;
            font-size: 15px;
            height: 5%;
        }

        .profileNavItem {
            width: 20%;
            text-align: center;
            height: 100%;
            align-items: center;
        }

        .profileNavItem:hover {
            color: #0f3b0f;
            background-color: white;
            padding: auto;
        }

        .button {
            height: 4%;
            background-color: #0f3b0f;
            color: white;
        }

        .button:hover {
            background-color: white;
            border: 1px solid #0f3b0f;
            color: #0f3b0f;
        }

        .my-card-group {
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
        }

        .my-card {
            display: flex;
            flex-direction: column;
            width: 33%;
            min-width: 0px;
            border: 1px solid rgba(0,0,0,.125);
        }

        .my-card-image {
            height: 10rem;
            width: 100%;
            background-color: grey;
            display: block;
        }

        .my-card-body {
            padding: 1.25rem;
            background-color: white;
            flex: 1 1 auto;
            font-size: 15px
        }

        .my-card-footer {
            background-color: lightgrey;
        }

        #name {
            margin-top: 15%;
            margin-bottom: 5%;
            display: flex;
            justify-content: center;
        }

    </style>
    <script>
        $(document).ready(function() {
            var current_section = $('#profile_section');
            $('#groups_section').hide();
            $('#settings_section').hide();


            $('#groups').on('click', function() {
                current_section.hide();
                $('#groups_section').show();
                current_section = $('#groups_section');
            });

            $('#settings').on('click', function() {
                current_section.hide();
                $('#settings_section').show();
                current_section = $('#settings_section');
            });
        })
    </script>
@endsection


@section('content')
    <div class="banner">
        <img src="{{$demographics->bannerImageLocation}}" alt="{{$user->name}}'s banner">
    </div>
    <div class="profile">
        <img src="{{$demographics->profileImageLocation}}" alt="{{$user->name}}'s profile image">
    </div>

    <div id="name">
        <h1>{{$user->name}}</h1>
    </div>

    <div class="profileNavBar">
        <div class="profileNavItem" id="details"><p>Details</p></div>
        <div class="profileNavItem" id="posts"><p>Posts</p></div>
        <div class="profileNavItem" id="groups"><p>Groups</p></div>
        <div class="profileNavItem" id="settings"><p>Settings</p></div>
        <div class="profileNavItem" id="friends"><p>Friends</p></div>
    </div>


    <!-- PROFILE SECTION -->
    <div id="profile_section">
        <h1>Hello From Profiles</h1>
    </div>

    <!-- GROUPS SECTION -->
    <div id="groups_section" >

        @foreach($groups->chunk(3) as $chunk)
        <div class="my-card-group">
            @foreach($chunk as $group)
            <div class="my-card">
                <img class="my-card-image" src="{{$group->bannerImage}}" alt="card Image">
                <div class="my-card-body">
                    <p>{{$group->bio}}</p>
                    <a href="{{url('/group/' . $group->id . '/view')}}" class="btn button">View Group</a>
                </div>
                <div class="my-card-footer">
                    <p class="text-muted">Edited on: {{$group->updated_at}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
        <div style="margin-top: 15px;">
            <a href="{{url('/group/create')}}" class="btn button">Create a new Group</a>
            <a href="{{url('/groups')}}" class="btn button">Join a new Group</a>
        </div>
    </div>
        {{--<div class="card-group" style="margin: 15px;">--}}
            {{--@forelse($groups->chunk(3) as $chunk)--}}
                {{--@foreach($chunk as $group)--}}
                    {{--<div class="card">--}}
                        {{--<img class="card-img-top" src="..." alt="Card image cap">--}}
                        {{--<div class="card-body">--}}
                            {{--<h5 class="card-title">Card title</h5>--}}
                            {{--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
                            {{--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--@empty--}}
                {{--@if(\Auth::User()->id === $userID)--}}
                    {{--<h1>Join or create a new group to see it listed here</h1>--}}
                {{--@endif--}}
            {{--@endforelse--}}
        {{--</div>--}}



@endsection






