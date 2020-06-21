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
        Simple welcome page as index page for project


*/
?>
@extends('layouts.app')

@section('title', 'Hello')


@section('content')
    <?php if (isset($_SESSION['userID'])) { ?>
        <h1>Hello. Welcome {{$firstname . " " . $lastname}}. </h1>
    <?php } else { ?>
        <h1>Please <a href="{{url('/loginRegister')}}">Login Or Register</a></h1>
    <?php }?>
@endsection