<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 6/22/2020
 * Time: 10:52 PM
 */
?>

@extends('layouts.app')

@section('head')
    <style>
        #submitButton {
            width: 30%;
        }
    </style>
    <script>
        function rename(elementName, numElements) {
            $('#' + elementName).attr('name', elementName + "_" + numElements);
            $('#' + elementName).attr('id', elementName + "_" + numElements);
        }

        $(document).ready(function() {
            var numElements = 0;

            //if elements exits call elementrename func
            if ($('#institutionName')) {

                @for($i = 1; $i <= session('numElements'); $i++)
                rename('institutionName', {{$i}});
                rename('from', {{$i}});
                rename('to', {{$i}});
                rename('description', {{$i}});
                rename('role', {{$i}});
                rename('isCurrent', {{$i}});

                $('#numElements').attr('value', {{$i}});
                @endfor

            }


            $('#addButton').on('click', function() {
                $.get('{{url('/educationHistory')}}', function (content) {
                    $('#replaceable').replaceWith(content);
                    numElements++;
                    document.getElementById('numElements').value = numElements;

                    $("#addedDiv").attr('id', "addedDiv_" + numElements);

                    $("#institutionName_r").attr('name', "institutionName_" + numElements);
                    $("#institutionName_r").attr('id', "institutionName_" + numElements);

                    $("#from_r").attr('name', "from_" + numElements);
                    $("#from_r").attr('id', "from_" + numElements);

                    $("#to_r").attr('name', "to_" + numElements);
                    $("#to_r").attr('id', "to_" + numElements);

                    $("#major_r").attr('name', "major_" + numElements);
                    $("#major_r").attr('id', "major_" + numElements);
                });
            });

            $('#deleteButton').on('click', function(){
                $("#addedDiv_" + numElements).replaceWith("<div id='replaceable'></div>");

                if (numElements >= 1) {
                    numElements--;
                    document.getElementById('numElements').value = numElements;
                }
            });
        });
    </script>
@endsection

@section('content')
    <h1>Enter your educational history</h1>
    <form id="educationHistoryForm" action="{{url('/profile/' . $userID . "/educationHistories")}}" method="post">
        @csrf

        @for($i = 1; $i <= session('numElements'); $i++)
        <div class="form-row">
            <div class="form-group col">
                <label for="institutionName" {{$errors->has('institutionName_' . $i) ? 'style=color:red' : ''}}>Institution Name</label>
                <input type="text" class="{{$errors->has('institutionName_' . $i) ? 'border border-danger' : ''}} form-control" name="institutionName" id="institutionName">
                @if ($errors->has('institutionName_' . $i))
                    <p style="color: red">{{$errors->first('institutionName_' . $i)}}</p>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="from" {{$errors->has('from_' . $i) ? 'style=color:red' : ''}}>From</label>
                <input type="date" class="{{$errors->has('from_' . $i) ? 'border border-danger' : ''}} form-control" name="from" id="from">
                @if ($errors->has('from_' . $i))
                    <p style="color: red">{{$errors->first('from_' . $i)}}</p>
                @endif
            </div>
            <div class="form-group col-6">
                <label for="to" {{$errors->has('to_' . $i) ? 'style=color:red' : ''}}>to</label>
                <input type="date" class="{{$errors->has('to_' . $i) ? 'border border-danger' : ''}} form-control" name="to" id="to">
                @if ($errors->has('to_' . $i))
                    <p style="color: red">{{$errors->first('to_' . $i)}}</p>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="major" {{$errors->has('major_' . $i) ? 'style=color:red' : ''}}>Major</label>
                <select id="major" name="major" class="{{$errors->has('major_' . $i) ? 'border border-danger' : ''}} form-control">
                    <option value="" disabled selected>Select</option>
                    <option value="B.S. in Computer Science">B.S. in Computer Science</option>
                    <option value="B.A. in Computer Science">B.A. in Computer Science</option>
                    <option value="B.S. in Physics">B.S. in Physics</option>
                    <option value="B.A. in Physics">B.A. in Physics</option>
                    <option value="B.S. in Electrical Engineering">B.S. in Electrical Engineering</option>
                    <option value="B.A. in Electrical Engineering">B.A. in Electrical Engineering</option>
                    <option value="M.S. in Computer Science">M.S. in Computer Science</option>
                    <option value="M.S. in Physics">M.S. in Physics</option>
                    <option value="M.S. in Electrical Engineering">M.S. in Electrical Engineering</option>
                </select>
                @if ($errors->has('major_' . $i))
                    <p style="color: red">{{$errors->first('major_' . $i)}}</p>
                @endif
            </div>
        </div>
        <br><br><br>
        @endfor

        <div id="replaceable"></div>
        <input type="hidden" value="0" name="numElements" id="numElements">
    </form>

    <button id="deleteButton" class="button">Delete Last History</button>
    <button id="submitButton" form="educationHistoryForm" class="button">Finish Setting up Profile</button>
    <button id="addButton" class="button">Add</button>



@endsection
