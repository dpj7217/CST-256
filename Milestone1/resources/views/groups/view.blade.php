@extends('layouts.app')
@section('title', 'Group')

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

        #profileName {
            margin-top: 15%;
            margin-bottom: 5%;
            display: flex;
            justify-content: center;
        }

        .section {
            margin-top: 15%;
        }

        .quadrant-container {
            display: flex;
            flex-wrap: wrap;
        }

        .quadrant {
            width: 50%;
            display: flex;
            justify-content: center;
            margin: 5% 0;
        }

    </style>
    <script>
        $(document).ready(function() {
            var current_section = $('#details_section');
            $('#settings_section').hide();
            $('#followers_section').hide();
            $('#posts_section').hide();

            $('#settings').on('click', function() {
                current_section.hide();
                $('#settings_section').show();
                current_section = $('#settings_section');
            });

            $('#followers').on('click', function() {
                current_section.hide();
                $('#followers_section').show();
                current_section = $('#followers_section');
            });

            $('#details').on('click', function() {
                current_section.hide();
                $('#details_section').show();
                current_section = $('#details_section');
            });

            $('#posts').on('click', function() {
                current_section.hide();
                $('#posts_section').show();
                current_section = $('#posts_section');
            });
        })
    </script>
@endsection


@section('content')
    <div class="banner">
        <img src="{{$group->bannerImage}}" alt="{{$group->name}}'s banner">
    </div>
    <div class="profile">
        <img src="{{$group->profileImage}}" alt="{{$group->name}}'s profile image">
    </div>

    <div id="profileName">
        <h1>{{$group->name}}</h1>
    </div>

    <div class="profileNavBar">
        <div class="profileNavItem" id="details"><p>Details</p></div>
        <div class="profileNavItem" id="posts"><p>Posts</p></div>
        @if($group->isOwner())
            <div class="profileNavItem" id="settings"><p>Settings</p></div>
        @endif
        <div class="profileNavItem" id="followers"><p>Followers</p></div>
    </div>



    <!-- DETAILS SECTION -->
    <div id="details_section" class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Details</div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" name="name" type="text" class="form-control" value="{{ $group->name }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bio" class="col-md-4 col-form-label text-md-right">Group Bio</label>

                                <div class="col-md-6">
                                    <textarea id="bio" name="bio" class="form-control" rows="5" disabled>{{ $group->bio }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="isPublic" class="col-md-4 col-form-label text-md-right">Public Group?</label>

                                <div class="col-md-6">
                                    <input type="text" name="isPublic" id="isPublic" class="form-control" disabled value="{{$group->isPublic ? 'Yes' : 'No'}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="isJoinable" class="col-md-4 col-form-label text-md-right" >Group is Joinable?</label>

                                <div class="col-md-6">
                                    <input type="text" name="isJoinable" id="isJoinable" class="form-control" disabled value="{{$group->isJoinable ? 'Yes' : 'No'}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- SETTINGS SECTION -->
    <?php \Auth::check() ? $userID = \Auth::user()->id : $userID = null?>
    <div id="settings_section" class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Group</div>

                        <div class="card-body">

                            <div class="quadrant-container">
                                @if($group->isOwner())
                                    <div class="quadrant">
                                        <a class="btn btn-outline-primary" href="{{url('/group/' . $group->id . '/edit')}}">Edit Group</a>
                                    </div>
                                    <div class="quadrant">
                                        <form action="{{url('/group/' . $group->id . '/delete')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-outline-danger" value="Delete Group">
                                        </form>
                                    </div>
                                @endif
                                <div class="quadrant">
                                    @if($group->users->contains($userID))
                                        <a class="btn btn-outline-warning" href="{{url('/group/' . $group->id . '/leave')}}">Leave Group</a>
                                    @else
                                        <a class="btn btn-outline-success" href="{{url('/group/' . $group->id . '/join')}}">Join Group</a>
                                    @endif
                                </div>
                                <div class="quadrant">
                                    <button class="btn btn-secondary" disabled>Coming Soon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- POSTS SECTION -->
    <div id="posts_section">
        <p style="width: 100%; display: flex; justify-content: center; background-color: red; color: white;">UNDER CONSTRUCTION</p>
    </div>



    <!-- FRIENDS SECTION -->
    <div id="followers_section">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Active User?</th>
                    <th>Site Admin?</th>
                </tr>
            </thead>
            @foreach($followers as $user)
                <tr>
                    <td><a href="{{url('/profile/' . $user->id . '/view')}}">{{$user->username}}</a></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->isActive ? 'Yes' : ''}}</td>
                    <td>{{$user->isAdmin ? 'Yes' : ''}}</td>
                </tr>
            @endforeach
        </table>
    </div>


@endsection