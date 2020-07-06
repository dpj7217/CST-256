@extends('layouts.app')

@section('title', 'Groups')

@section('content')
    @if ($userGroups->count())
        My Groups <hr>

        @foreach($userGroups->chunk(3) as $chunk)
            <div class="my-card-group">
                @foreach($chunk as $group)
                    <div class="my-card">
                        <img class="my-card-image" src="{{$group->profileImage}}" alt="card Image">
                        <div class="my-card-body">
                            <p>{{$group->bio}}</p>
                        </div>
                        <hr>
                        <div class="my-card-body">
                            <a href="{{url('/group/' . $group->id . '/view')}}" class="btn button">View Group</a>
                        </div>
                        <div class="my-card-footer">
                            <p class="text-muted">Edited on: {{$group->updated_at}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        <hr>
        <br><br>
    @endif

    All Available Groups <hr>
    @foreach($groups->chunk(3) as $chunk)
        <div class="my-card-group">
            @foreach($chunk as $group)
                @if(!($user->groups->where('id', $group->id)->count()))
                <div class="my-card">
                    <img class="my-card-image" src="{{$group->profileImage}}" alt="card Image">
                    <div class="my-card-body">
                        <p>{{$group->bio}}</p>
                    </div>
                    <hr>
                    <div class="my-card-body">
                        <form action="{{url('/group/' . $group->id . '/view')}}" method="get">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <input class="btn button" type="submit" value="View Group">
                        </form>
                    </div>
                    <div class="my-card-footer">
                        <p class="text-muted">Edited on: {{$group->updated_at}}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endforeach

@endsection