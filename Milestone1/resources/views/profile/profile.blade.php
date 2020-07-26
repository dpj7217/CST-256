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

        #addPost {
            border: 1px solid black;
            border-radius: 25px;
            color: white;
            text-align: left;
            background-color: #3A3B3C;
            margin-left: 5px;
            height: 100%;
        }

        #addPost:hover {
            background-color: #5C5A58;
        }

        .modal {
            top: 33%;
        }

        .post_section {
            height: 50px;
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .post_img {
            height: 50px;
            width: 50px;
            border-radius: 50px;
            border: 1px solid black;
        }

        .section {
            margin: auto;
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

            $('#profile_section').on('click', function() {
                $('#error').hide();
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
                            <form method="POST" action=" {{ url('/profile/' . $user->id . '/edit') }} ">
                                @csrf
                                @method('patch')

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
                                    <label for="age" class="col-md-2 col-form-label text-md-right"><strong>Age</strong></label>

                                    <div class="col-md-10">
                                        <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $demographics->age }}" required autofocus>

                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bio" class="col-md-2 col-form-label text-md-right"><strong>Bio</strong></label>

                                    <div class="col-md-10">
                                        <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="10" required autofocus>{{ $demographics->bio }}</textarea>

                                        @error('bio')
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
                                        <input type="text" id="fromCity" class="form-control @error('fromCity') is-invalid @enderror" name="fromCity" value="{{ $demographics->fromCity }}" required autofocus>

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
                                        <input type="text" id="currentCity" class="form-control @error('birthday') is-invalid @enderror" name="currentCity" value="{{ $demographics->currentCity }}" required autofocus>

                                        @error('currentCity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>

                                    <div class="col-md-10">
                                        <input type="submit" class="btn button" style="height: 100%;" value="Submit Edits to Demographics">
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
                    <?php $index = 0?>

                    @if(\Auth::user()->id == $user->id && $workHistory)
                        <div class="card-body">
                            <form action="{{ url('/profile/' . $user->id . '/workHistory/edit') }}" method="POST">
                                @csrf
                                @method('patch')
                                @foreach($workHistory as $job)

                                <div class="sectionHeader">
                                    <p style="padding: .35rem">Job {{ $index + 1 }}</p>
                                </div>

                                <input type="hidden" name="workIDAt_{{ $index }}" value="{{ $job->id }}">


                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right" for="companyName"><strong>Company Name</strong></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="companyName_{{ $index }}" id="companyName" value="{{ $job->companyName }}">

                                        @error('companyName_{{$index}}')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right" for="role"><strong>Role</strong></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="role_{{ $index }}" id="role" value="{{ $job->role }}">

                                        @error('role_{{$index}}')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right" for="description"><strong>Description</strong></label>

                                    <div class="col-md-10">
                                        <textarea class="form-control" name="description_{{ $index }}" id="description" rows="10">{{ $job->description }}</textarea>

                                        @error('description_{{$index}}')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right" for="from"><strong>Started</strong></label>

                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="from_{{ $index }}" id="from" value="{{ $job->from }}">

                                        @error('from_{{$index}}')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right" for="to"><strong>Finished?</strong></label>

                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="to_{{ $index }}" id="to" value="{{ $job->to }}">

                                        @error('to_{{$index}}')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <?php $index++ ?>
                                @endforeach

                                <input type="hidden" value="{{ $index }}" name="numElements">

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>

                                    <div class="col-md-10">
                                        <input type="submit" class="btn button" value="Submit Edits to Work History" style="height: 100%;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    @elseif(\Auth::user()->id == $user->id && !$workHistory)
                        <div class="emptyDiv">
                            <p>You have no work history information on file yet. <a href="{{ url('/profile/' . $user->id . '/workHistory') }}" style="color: blue;">Add it</a> to see it here.</p>
                        </div>
                    @elseif($workHistory)
                        <div class="card-body">
                            @foreach($workHistory as $job)
                                <div class="sectionHeader">
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
                        <div class="emptyDiv">
                            <p>No work history is on file for this person yet.</p>
                        </div>
                    @endif


                    <!-- EDUCATION SECTION -->
                    <div class="card-header">Education History</div>
                        @if(\Auth::user()->id == $user->id && $educationHistory)
                            <div class="card-body">
                                <p id="error" style="color: red;">{{ session('error') }}</p>
                                <?php $index = 0; ?>
                                <form action="{{ url('/profile/' . $user->id . '/educationHistories/edit') }}" method="POST">
                                    @csrf
                                    @method('patch')

                                    @foreach($educationHistory as $school)
                                        <div class="sectionHeader">
                                            <p style=" padding: .35rem">School {{ $index + 1 }}</p>
                                        </div>

                                        <input type="hidden" name="schoolIDAt{{ $index }}" value="{{ $school->id }}">
                                        @error('schoolIDAt{{$index}}')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-md-right" for="institutionName_{{ $index }}"><strong>Institution Name</strong></label>

                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="institutionName_{{ $index }}" value="{{ $school->institutionName }}">

                                                @error('institutionName_{{$index}}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-md-right" for="major_{{ $index }}"><strong>Major</strong></label>

                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="major_{{ $index }}" value="{{ $school->major }}">

                                                @error('major_{{$index}}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-md-right" for="from_{{ $index }}"><strong>Started</strong></label>

                                            <div class="col-md-10">
                                                <input type="date" class="form-control" name="from_{{ $index }}" value="{{ $school->from }}">

                                                @error('from_{{$index}}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-md-right" for="to_{{ $index }}"><strong>Finished?</strong></label>

                                            <div class="col-md-10">
                                                <input type="date" class="form-control" name="to_{{ $index }}" value="{{ $school->to }}">

                                                @error('to_{{$index}}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <?php $index++; ?>
                                    @endforeach

                                    <input type="hidden" value="{{ $index }}" name="numElements">

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-md-right"></label>

                                        <div class="col-md-10">
                                            <input type="submit" class="btn button" value="Submit Edits to Education History" style="height: 100%;">
                                        </div>
                                    </div>

                                    </form>
                            </div>
                        @elseif(\Auth::user()->id == $user->id && !$educationHistory)
                            <div class="emptyDiv">
                                <p>You have no work history information on file yet. <a href="{{ url('/profile/' . $user->id . '/educationHistory') }}" style="color: blue;">Add it</a> to see it here.</p>
                            </div>
                        @elseif($educationHistory)
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
                            <div class="emptyDiv">
                                <p>No education history is on file for this person yet.</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>



    <!-- SOCIAL SECTION -->
    <div id="social_section" class="section">

        @foreach($groups->chunk(3) as $chunk)
        <div class="my-card-group">
            @foreach($chunk as $group)
            <div class="my-card">
                <img class="my-card-image" src="{{$group->bannerImage}}" alt="card Image">
                <div class="my-card-header">
                    <p>{{$group->name}}</p>
                </div>
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
        @if($user->id == \Auth::user()->id)
            <div class="post_section">
                <img class="post_img" src="{{ $demographics ? $demographics->profileImageLocation : asset('storage/images/defaultProfileImage.jpg')}}">
                <button class="col" id="addPost" name="post_text" data-toggle="modal" data-target="#exampleModal">
                    Write something for your friends to see.
                </button>
            </div>
            @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Create A New Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="post_form" action="{{ url('post/create') }}" method="POST">
                                @csrf
                                <textarea id="post_text" name="post_text" placeholder="Write something for your friends to see." class="form-control" rows="10"></textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="col btn button" id="post_btn" form="post_form">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        @forelse($user->posts as $post)
            <div class="card" style="margin-top: 5%;">
                <div class="card-header">
                    <div style="display: flex; justify-content: flex-start;">
                        <img src="{{$demographics->profileImageLocation}}" class="post_img">
                        <div style="margin: auto 5px;">
                            <h5>{{ $post->user->name }}</h5>
                            <small class="text-muted">Posted On: {{ $post->created_at }}</small>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <p>{{ $post->post_text }}</p>
                </div>
                @if($post->likes->count() == 1)
                    <div class="card-footer">
                        {{ $post->likes->count() }} Like
                    </div>
                @else
                    <div class="card-footer">
                        {{ $post->likes->count() }} Likes
                    </div>

                @endif
                <div class="card-footer" style="display:flex; justify-content: space-around;">
                    <div class="col">
                        <form action="{{ url('/like/' . $post->id . '/create') }}" method="POST">
                            @csrf
                            <button class="btn button col mx-1" style="height: 100%;" {{ $post->likes->pluck('user_id')->contains(\Auth::user()->id) ? 'disabled' : '' }}>Like</button>
                        </form>
                    </div>
                    <div class="col">
                        <button class="btn button col mx-1" data-toggle="modal" data-target="#commentModal" style="height: 100%;">Comment</button>
                        @if(session( $post->id  . '_error'))
                            <p style="color: red;">{{ session($post->id . '_error') }}</p>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @foreach($post->comments as $comment)
                        <div style="display: flex; justify-content: flex-start; height: 100%;">
                            <img src="{{ $comment->user->profile->demographics->profileImageLocation }}" class="post_img">
                            <div style="margin: auto 5px; height: 100%;">
                                <p>{{ $comment->comment_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Comment On {{ $post->user->name }}'s Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="comment_form" action="{{ url('/comment/' . $post->id . '/create') }}" method="POST">
                                @csrf
                                <textarea id="comment_text" name="comment_text" placeholder="Comment On {{ $post->user->name }}'s post" class="form-control" rows="10"></textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="col btn button" id="comment_btn" form="comment_form">Add Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse

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






