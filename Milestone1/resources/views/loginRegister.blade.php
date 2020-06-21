<?php
/*
    Project:
        Socialis: V1.0
    Module:
        Socialis: V1.0
    Author:
        David Pratt Jr.
    Date:
        6/14/2020
    Synopsis:
        Login Register Forms


*/

?>

@extends('layouts.app')

@section('title', 'Login Or Register')


@section('content')
	<div class=row style="margin-top: 5%">



		<div class="col-6" >
            <form method="post" action="{{url('/login')}}">
        		<h3>Login</h3>
				@csrf
    			<div class=form-group>
    				<label {{ $errors->has('loginUsername') ? 'style=color:#dc3545;' : '' }} for=loginUsername>Username</label>
        			<input type=text class="{{ $errors->has('loginUsername') ? 'border border-danger' : '' }} form-control" id=loginUsername name=loginUsername>
                    @if ($errors->has('loginUsername'))
                        <p class="text-danger">{{$errors->first('loginUsername')}}</p>
                    @endif
        		</div>
        		<div class=form-group>
        			<label {{ $errors->has('loginPassword') ? 'style=color:#dc3545' : '' }} for=loginPassword>Password</label>
        			<input type=text class="{{ $errors->has('loginPassword') ? 'border border-danger' : '' }} form-control" id=loginPassword name=loginPassword>
                    @if ($errors->has('loginPassword'))
                        <p class="text-danger">{{$errors->first('loginPassword')}}</p>
                    @endif
                </div>
        		<input type=submit class="btn btn-outline-success" value="Login">
        	</form>
    	</div>





        <div class="col-6">
            <form method="POST" action="{{url('/register')}}">
                <h3>Register</h3>
                @csrf
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="firstname" {{$errors->has('firstname') ? 'style=color:#db3545' : ''}}>First Name</label>
                        <input type="text" class="{{$errors->has('firstname') ? 'border border-danger' : ''}} form-control" id="firstname" name="firstname">
                        @if ($errors->has('firstname'))
                            <p class="text-danger">{{$errors->first('firstname')}}</p>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="lastname" {{$errors->has('lastname') ? 'style=color:#db3545' : ''}} >Last Name</label>
                        <input type="text" class="{{$errors->has('lastname') ? 'border border-danger' : ''}} form-control" id="lastname" name="lastname">
                        @if ($errors->has('lastname'))
                            <p class="text-danger">{{$errors->first('lastname')}}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" {{$errors->has('email') ? 'style=color:#db3545' : ''}}>Email</label>
                    <input type="email" class="{{$errors->has('email') ? 'border border-danger' : ''}} form-control" id="email" name="email">
                    @if ($errors->has('email'))
                        <p class="text-danger
">{{$errors->first('email')}}</p>
                    @endif

                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="username" {{$errors->has('username') ? 'style=color:#db3545' : ''}}>Username</label>
                        <input type="text" class="{{$errors->has('username') ? 'border border-danger' : ''}} form-control" id="username" name="username">
                        @if ($errors->has('username'))
                            <p class="text-danger">{{$errors->first('username')}}</p>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="password" {{$errors->has('password') ? 'style=color:#db3545' : ''}}>Password</label>
                        <input type="password" class="{{$errors->has('password') ? 'border border-danger' : ''}} form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <p class="text-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="passwordconf" {{$errors->has('passwordconf') ? 'style=color:#db3545' : ''}}>Confirm Password</label>
                        <input type="password" class="{{$errors->has('passwordconf') ? 'border border-danger' : ''}} form-control" id="passwordconf" name="passwordconf">
                        @if ($errors->has('passwordconf'))
                            <p class="text-danger">{{$errors->first('passwordconf')}}</p>
                        @endif
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-success" value="Submit">
            </form>
        </div>
    </div>

@endsection