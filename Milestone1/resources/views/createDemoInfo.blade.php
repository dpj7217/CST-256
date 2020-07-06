<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 6/17/2020
 * Time: 8:38 PM
 */
?>

@extends("layouts.app")

@section('title', 'Demographics')

@section('head')
<style>
    .button {
        background: white;
        border: 1px dashed blue;
        height: 45px;
    }

    .button:hover {
        background-color: lightblue;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button
    {
        width: 45px;
        height: 30px;
        line-height: 1.65;
        float: left;
        display: block;
        margin: 0;
        padding-left: 20px;
        border: 1px solid #eee;
    }
</style>
@endsection

@section('content')
    <div style="margin: 30px 0px">
        <?php $error = session('error')?>
        @if(isset($error))
            <div class="col bg-danger text-white">
                    <h3>{{$error}}</h3>
            </div>
        @endif
        <form action="{{url('/profile/' . $userID . '/create')}}" enctype="multipart/form-data" method="POST">
            @csrf


            <div class="form-row">
                <div class="form-group col">
                    <label {{ $errors->has('birthday') ? 'style=color:#dc3545;' : '' }} for="birthday">Birthday</label>
                    <input type="date" class="{{ $errors->has('birthday') ? 'border border-danger' : '' }} form-control" name="birthday" id="birthday">
                    @if ($errors->has('birthday'))
                        <p class="text-danger">{{$errors->first('birthday')}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">


                <div class="form-group col-6">
                    <label {{ $errors->has('currCity') ? 'style=color:#dc3545;' : '' }} for="currCity">I Currently Reside In</label>
                    <input type="text" class="{{ $errors->has('currCity') ? 'border border-danger' : '' }} form-control" name="currCity" id="currCity" placeholder="City, State">
                    @if ($errors->has('currCity'))
                        <p class="text-danger">{{$errors->first('currCity')}}</p>
                    @endif
                </div>


                <div class="form-group col-6">
                    <label {{ $errors->has('fromCity') ? 'style=color:#dc3545;' : '' }} for="fromCity">I Am From</label>
                    <input type="text" class="{{ $errors->has('fromCity') ? 'border border-danger' : '' }} form-control" name="fromCity" id="fromCity" placeholder="City, State">
                    @if ($errors->has('fromCity'))
                        <p class="text-danger">{{$errors->first('fromCity')}}</p>
                    @endif
                </div>


            </div>


            <div class="form-row">
                <label {{ $errors->has('bio') ? 'style=color:#dc3545;' : '' }} for="bio">Bio</label>
                <textarea class="{{ $errors->has('bio') ? 'border border-danger' : '' }} form-control" name="bio" id="bio" rows="5"></textarea>
                @if ($errors->has('bio'))
                    <p class="text-danger">{{$errors->first('bio')}}</p>
                @endif
            </div>



            <div class="form-row">


                <div class="form-group col-4">
                    <label {{ $errors->has('gender') ? 'style=color:#dc3545;' : '' }} for="gender">Gender</label>
                    <select id="gender" name="gender" class="{{ $errors->has('gender') ? 'border border-danger' : '' }} form-control">
                        <option value="" disabled selected>--select one--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="notspecified">I Prefer not to Specify</option>
                    </select>
                    @if ($errors->has('gender'))
                        <p class="text-danger">{{$errors->first('gender')}}</p>
                    @endif
                </div>


                <div class="form-group col-8">
                    <fieldset>
                        <label {{ $errors->has('ethnicity') ? 'style=color:#dc3545;' : '' }} for="ethnicity">Ethnicity</label>
                        <select class="{{ $errors->has('ethnicity') ? 'border border-danger' : '' }} form-control dropdown" id="ethnicity" name="ethnicity">
                            <option value="" selected="selected" disabled="disabled">-- select one --</option>
                            <optgroup label="White">
                                <option value="White English">English</option>
                                <option value="White Welsh">Welsh</option>
                                <option value="White Scottish">Scottish</option>
                                <option value="White Northern Irish">Northern Irish</option>
                                <option value="White Irish">Irish</option>
                                <option value="White Gypsy or Irish Traveller">Gypsy or Irish Traveller</option>
                                <option value="White Other">Any other White background</option>
                            </optgroup>
                            <optgroup label="Mixed or Multiple ethnic groups">
                                <option value="Mixed White and Black Caribbean">White and Black Caribbean</option>
                                <option value="Mixed White and Black African">White and Black African</option>
                                <option value="Mixed White Other">Any other Mixed or Multiple background</option>
                            </optgroup>
                            <optgroup label="Asian">
                                <option value="Asian Indian">Indian</option>
                                <option value="Asian Pakistani">Pakistani</option>
                                <option value="Asian Bangladeshi">Bangladeshi</option>
                                <option value="Asian Chinese">Chinese</option>
                                <option value="Asian Other">Any other Asian background</option>
                            </optgroup>
                            <optgroup label="Black">
                                <option value="Black African">African</option>
                                <option value="Black African American">African American</option>
                                <option value="Black Caribbean">Caribbean</option>
                                <option value="Black Other">Any other Black background</option>
                            </optgroup>
                            <optgroup label="Other ethnic groups">
                                <option value="Arab">Arab</option>
                                <option value="Hispanic">Hispanic</option>
                                <option value="Latino">Latino</option>
                                <option value="Native American">Native American</option>
                                <option value="Pacific Islander">Pacific Islander</option>
                                <option value="Other">Any other ethnic group</option>
                                <option value="none">I prefer not to specify</option>
                            </optgroup>
                        </select>
                    </fieldset>
                    @if ($errors->has('ethnicity'))
                        <p class="text-danger">{{$errors->first('ethnicity')}}</p>
                    @endif
                </div>


            </div>



            <div class="form-row">
                <div class="form-group col">
                    <label {{ $errors->has('age') ? 'style=color:#dc3545;' : '' }} for="age">Age</label>
                    <input type="number" min="18" max="90" id="age" name="age" class="{{ $errors->has('age') ? 'border border-danger' : '' }} form-control" placeholder="18">
                    @if ($errors->has('age'))
                        <p class="text-danger">{{$errors->first('age')}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">


                <div class="form-group col-3">
                    <label {{ $errors->has('profileImage') ? 'style=color:#dc3545;' : '' }} for="profileImage" id="inputFileLabel">Upload Profile Picture</label>
                    <input type="file" {{ $errors->has('inputFile') ? 'class="border border-danger"' : '' }} name="profileImage" id="profileImage">
                </div>
                @if ($errors->has('profileImage'))
                    <p class="text-danger">{{$errors->first('profileImage')}}</p>
                @endif


                <div class="form-group col-3">
                    <label {{$errors->has('bannerImage') ? 'style=color:#dc3545;' : ''}} for="bannerImage" id="bannerImageLabel">Upload Banner Image</label>
                    <input type="file" {{$errors->has('bannerImage') ? 'class="border border-danger"' : ''}} name="bannerImage" id="bannerImage">
                </div>
                @if ($errors->has('bannerImage'))
                    <p class="text-danger">{{$errors->first('bannerImage')}}</p>
                @endif
            </div>






            <input type="hidden" value="{{$userID}}" name="userID" id="userID">


            <input type="submit" class="button col-3" value="Move on to Job History">
        </form>
    </div>
@endsection

