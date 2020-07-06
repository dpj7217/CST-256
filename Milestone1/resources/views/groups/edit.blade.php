@extends('layouts.app')

@section('title', 'Edit Group')

@section('content')
    <div style="margin-top: 15%;"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Group</div>

                    <div class="card-body">
                        <form action="{{url('/group/' . $group->id . '/edit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right @error('name') text-danger @enderror">Group Name</label>

                                <div class="col-md-6">
                                    <input id="name" name="name" type="text" class="form-control @error('name') border border-danger @enderror" value="{{ $group->name }}" required autofocus>

                                    @error('name')
                                    <div class="text-danger" role="alert">
                                        <p><strong>{{ $message }}</strong></p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bio" class="col-md-4 col-form-label text-md-right @error('bio') is=invalid @enderror">Group Bio</label>

                                <div class="col-md-6">
                                    <textarea id="bio" name="bio" class="form-control @error('name') border border danger @enderror" rows="5">{{ $group->bio }}</textarea>

                                    @error('bio')
                                    <div class="text-danger" role="alert">
                                        <p><strong>{{ $message }}</strong></p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profileImage" class="col-md-4 col-form-label text-md-right @error('profileImage') text-danger @enderror">Update Profile Image?</label>

                                <div class="col-md-6">
                                    <input id="profileImage" name="profileImage" type="file" class="form-control @error('profileImage') border border-danger @enderror">

                                    @error('profileImage')
                                    <div class="text-danger" role="alert">
                                        <p><strong>{{ $message }}</strong></p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bannerImage" class="col-md-4 col-form-label text-md-right @error('bannerImage') text-danger @enderror">Update Banner Image?</label>

                                <div class="col-md-6">
                                    <input id="bannerImage" name="bannerImage" type="file" class="form-control @error('bannerImage') border border-danger @enderror">

                                    @error('bannerImage')
                                    <div class="text-danger" role="alert">
                                        <p><strong>{{ $message }}</strong></p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="isPublic" id="isPublic" {{ $group->isPublic ? 'checked' : '' }}>

                                        <label class="form-check-label" for="isPublic">Make this a public group?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn button">Submit Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection