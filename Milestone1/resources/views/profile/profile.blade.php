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
    <div id="groups_section" class="section">

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




@endsection






