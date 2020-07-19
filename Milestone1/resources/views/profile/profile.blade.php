<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 6/19/2020
 * Time: 2:56 PM
 */

function formatDate($date) {
    $date = explode('-', $date);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];

    return $month . '/' . $day . '/' . $year;

}
?>
@extends('layouts.app')
@section('title', 'My Profile')

@section('head')
    <style>
        .text-box {
            text-align: left;
            width: 100%;
            color: #495057;
            line-height: 1.5;
            padding: .375rem .75rem;
        }

        #name {
            margin-top: 15%;
            margin-bottom: 5%;
            display: flex;
            justify-content: center;
        }

        .emptyDiv {
            color: red;
            text-align: center;
        }

        .sectionHeader {
            display: block;
            width: 100%;
            height: 3%;
            border-bottom: 1px solid lightgrey;
            margin-bottom: 15px;
        }

    </style>
    <script>
        $(document).ready(function() {
            var current_section = $('#feed_section');
            $('#social_section').hide();
            $('#settings_section').hide();
            $('#profile_section').hide();

            $('#profile').on('click', function() {
                current_section.hide();
                $('#profile_section').show();
                current_section = $('#profile_section');
            });

            $('#social').on('click', function() {
                current_section.hide();
                $('#social_section').show();
                current_section = $('#social_section');
            });

            $('#feed').on('click', function() {
                current_section.hide();
                $('#feed_section').show();
                current_section = $('#feed_section');
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
    @if ($demographics)
        <div class="banner">
            <img src="{{$demographics->bannerImageLocation}}" alt="{{$user->name}}'s banner">
        </div>
        <div class="profile">
            <img src="{{$demographics->profileImageLocation}}" alt="{{$user->name}}'s profile image">
        </div>
    @else
        <div class="banner">
            <img src="{{asset('storage/images/defaultBannerImage.jpg')}}" alt="Not Found">
        </div>
        <div class="profile">
            <img src="{{asset('storage/images/defaultProfileImage.jpg')}}" alt="Not Found" height="400" width="400">
        </div>
    @endif

    <div id="name">
        <h1>{{$user->name}}</h1>
    </div>

    {{-- Contact Info here?? --}}

    <div class="profileNavBar">
        <div class="profileNavItem" id="profile"><p>Profile</p></div> <!-- section showing work and education history information -->
        <div class="profileNavItem" id="feed"><p>Feed</p></div> <!-- section showing posts and media -->
        <div class="profileNavItem" id="social"><p>Social</p></div> <!-- section showing groups and friends -->
        @if(\Auth::user()->id == $user->id)
           <div class="profileNavItem" id="settings"><p>Settings</p></div> <!-- section for user's own profile allowing edits to profile picture, banner picture, change is active or delete account -->
        @endif
    </div>


    <!-- PROFILE SECTION -->
    <div id="profile_section">
        <div style="margin-top: 15%;"></div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <!-- DEMOGRAPHICS SECTION -->
                    <div class="card-header">Profile</div>

                    @if($user->id == \Auth::user()->id && $demographics)
                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right"><strong>Email</strong></label>

                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right"><strong>Age</strong></label>

                                    <div class="col-md-10">
                                        <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="email" value="{{ $demographics->age }}" required autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bio" class="col-md-2 col-form-label text-md-right"><strong>Bio</strong></label>

                                    <div class="col-md-10">
                                        <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="email" rows="10" required autofocus>{{ $demographics->bio }}</textarea>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birthday" class="col-md-2 col-form-label text-md-right"><strong>Birthday</strong></label>

                                    <div class="col-md-10">
                                        <input type="date" id="birthday" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ $demographics->birthday }}" required autofocus>

                                        @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fromCity" class="col-md-2 col-form-label text-md-right"><strong>From</strong></label>

                                    <div class="col-md-10">
                                        <input type="text" id="fromCity" class="form-control @error('birthday') is-invalid @enderror" name="fromCity" value="{{ $demographics->fromCity }}" required autofocus>

                                        @error('fromCity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="currentCity" class="col-md-2 col-form-label text-md-right"><strong>Lives In</strong></label>

                                    <div class="col-md-10">
                                        <input type="text" id="currentCity" class="form-control @error('birthday') is-invalid @enderror" name="fromCity" value="{{ $demographics->currentCity }}" required autofocus>

                                        @error('currentCity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                            </form>
                        </div>
                    @elseif(\Auth::user()->id == $user->id && !$demographics)
                        <div class="emptyDiv">
                            <p>You have no demographic information on file yet. <a href="{{ url('/profile/' . $user->id . '/create') }}" style="color: blue;">Add it</a> to see it here.</p>
                        </div>
                    @elseif($demographics)
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right"><strong>Email</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <P>{{ $user->email }}</P>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right"><strong>Age</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <P>{{ $demographics->age }}</P>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right"><strong>Bio</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <P>{{ $demographics->bio }}</P>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right" ><strong>Birthday</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <p>{{ formatDate($demographics->birthday ) }}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right" ><strong>From</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <p>{{ $demographics->fromCity }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right"><strong>Lives In</strong></label>

                                <div class="col-md-10">
                                    <div class="text-box">
                                        <p>{{ $demographics->currentCity }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @else
                            <div class="emptyDiv">
                                <p>No demographic information is on file for this person yet.</p>
                            </div>
                    @endif



                    <!-- WORK HISTORY SECTION  -->
                    <div class="card-header">Work History</div>

                    @if($workHistory)
                        <div class="card-body">
                            <?php $index = 1;?>
                            @foreach($workHistory as $job)
                                <div class="sectionHeader" style="">
                                    <p style=" padding: .35rem">Job {{ $index }}</p>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Company Name</strong></label>

                                    <div class="col-md-10">
                                        <div class="text-box">
                                            <p>{{ $job->companyName }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Role</strong></label>

                                    <div class="col-md-10">
                                        <div class="text-box">
                                            <p>{{ $job->role }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Description</strong></label>

                                    <div class="col-md-10">
                                        <div class="text-box">
                                            <p>{{ $job->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Started</strong></label>

                                    <div class="col-md-10">
                                        <div class="text-box">
                                            <p>{{ formatDate($job->from) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"><strong>Finished?</strong></label>


                                    <div class="col-md-10">
                                        <div class="text-box">
                                            <p>{{ $job->current ? 'I Currently Work Here' : formatDate($job->to) }}</p>
                                        </div>
                                    </div>
                                </div>


                                <?php $index++; ?>
                            @endforeach
                        </div>
                    @else
                        @if ($user->id == \Auth::user()->id)
                            <div class="emptyDiv">
                                <p>You haven't submitted your work history yet. <a style="color: blue; " href="{{ url('/profile/' . $user->id . '/workHistory') }}">Submit now</a> to be recommended jobs that match with your previous work history and to make applying easier</p>
                            </div>
                        @else
                            <div class="emptyDiv">
                                <p>No work history is on file for this person yet.</p>
                            </div>
                        @endif
                    @endif


                    <!-- EDUCATION SECTION -->
                    <div class="card-header">Education History</div>
                        @if($educationHistory)
                            <div class="card-body">
                                <?php $index = 1; ?>
                                @foreach($educationHistory as $school)
                                    <div class="sectionHeader">
                                        <p style="padding: .35rem">Institution {{ $index }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-md-right"><strong>Institution Name</strong></label>

                                        <div class="col-md-10">
                                            <div class="text-box">
                                                <p id="institutionName">{{ $school->institutionName }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-md-right"><strong>Major</strong></label>

                                        <div class="col-md-10">
                                            <div class="text-box">
                                                <p id="major">{{ $school->major }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-md-right"><strong>Started</strong></label>

                                        <div class="col-md-10">
                                            <div class="text-box">
                                                <p id="started">{{ formatDate($school->from) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-md-right"><strong>Finished</strong></label>

                                        <div class="col-md-10">
                                            <div class="text-box">
                                                <p id="started">{{ formatDate($school->to) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $index++; ?>
                                @endforeach
                            </div>
                        @else
                            @if($user->id == \Auth::user()->id)
                                <div class="emptyDiv">
                                    <p>You haven't submitted your education history yet. <a style="color: blue; " href="{{ url('/profile/' . $user->id . '/workHistory') }}">Submit now</a> to be recommended jobs that match with your education and to make applying easier</p>
                                </div>
                            @else
                                <div class="emptyDiv">
                                    <p>No education history is on file for this person yet.</p>
                                </div>
                            @endif
                        @endif
                </div>
            </div>
        </div>l
    </div>



    <!-- SOCIAL SECTION -->
    <div id="social_section" class="section">

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

        {{-- friends list here --}}
    </div>

    <!-- FEED SECTION -->
    <div id="feed_section" class="section">

    </div>

    @if(\Auth::user()->id == $user->id)
    <!-- Settings Section -->
    <div id="settings_section" class="section">
        <div style="margin-top: 15%;"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Settings</div>
                        {{--settings here--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection






