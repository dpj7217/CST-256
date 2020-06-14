@extends('layouts.app')

@section('title', 'Page Title')


@section('content')
    <?php if (isset($_SESSION['userID'])) { ?>
        <h1>Hello. Welcome {{$firstname . " " . $lastname}}. </h1>
    <?php } else { ?>
        <h1>Please <a href="{{url('/loginRegister')}}">Login Or Register</a></h1>
    <?php }?>
@endsection