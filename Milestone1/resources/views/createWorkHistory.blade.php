@extends('layouts.app')

@section('title', 'Create Work History')

@section('head')
    <style>
        #button {
            height: 3rem;
            box-shadow: none;
            background-color: white;
            border: dashed 1px rgb(0, 149, 255);
            width: 20%;
        }

        #button:focus {
            border: dashed 1px rgb(0, 149, 255);
        }
    </style>
@endsection

@section('content')
    <div style="margin-top: 30px; margin-bottom: 30px;">
        <h2>Let's start by filling out your work history!</h2>
        <h5>List previous 3 jobs from most recent to oldest</h5>
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col">
                    <label for="companyName1">Company Name</label>
                    <input type="text" class="form-control" id="companyName1" name="companyName1">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="from1">From</label>
                    <input type="date" name="from1" id="from1" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="to1">From</label>
                    <input type="date" name="to1" id="to1" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="1" id="isCurrent1">
                    <label for="isCurrent1" class="form-check-label">I Currently Work Here</label>
                </div>
            </div>
            <br/><br/><br/>


            <div class="form-row">
                <div class="form-group col">
                    <label for="companyName2">Company Name</label>
                    <input type="text" class="form-control" id="companyName2" name="companyName2">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="from2">From</label>
                    <input type="date" name="from2" id="from2" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="to2">From</label>
                    <input type="date" name="to2" id="to2" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="1" id="isCurrent2">
                    <label for="isCurrent2" class="form-check-label">I Currently Work Here</label>
                </div>
            </div>



            <br/><br/><br/>
            <div class="form-row">
                <div class="form-group col">
                    <label for="companyName3">Company Name</label>
                    <input type="text" class="form-control" id="companyName3" name="companyName3">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="from3">From</label>
                    <input type="date" name="from3" id="from3" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="to3">From</label>
                    <input type="date" name="to3" id="to3" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="1" id="isCurrent3">
                    <label for="isCurrent3" class="form-check-label">I Currently Work Here</label>
                </div>
            </div>
        </form>
    </div>
@endsection


