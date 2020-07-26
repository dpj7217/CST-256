@extends('layouts.app')

@section('title', 'Create Work History')

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
            if ($('#companyName')) {

                @for($i = 1; $i <= session('numElements'); $i++)
                rename('companyName', {{$i}});
                rename('from', {{$i}});
                rename('to', {{$i}});
                rename('description', {{$i}});
                rename('role', {{$i}});
                rename('isCurrent', {{$i}});

                $('#numElements').attr('value', {{$i}});
                @endfor

            }


            $('#addButton').on('click', function(){
                $.get('{{url('/workHistory')}}', function(content){
                    $('#replaceable').replaceWith(content);
                    numElements++;
                    document.getElementById('numElements').value = numElements;


                    $("#companyName_r").attr('name', "companyName_" + numElements);
                    $("#companyName_r").attr('id', "companyName_" + numElements);

                    $("#companyLabel_r").attr('for', "companyName_" + numElements);
                    $("#companyLabel_r").attr('id', "companyLabel_" + numElements);

                    $("#from_r").attr('name', "from_" + numElements);
                    $("#from_r").attr('id', "from_" + numElements);

                    $("#fromLabel_r").attr('for', "from_" + numElements);
                    $("#fromLabel_r").attr('id', "fromLabel_" + numElements);

                    $("#to_r").attr('name', "to_" + numElements);
                    $("#to_r").attr('id', "to_" + numElements);

                    $("#toLabel_r").attr('for', "toLabel_" + numElements);
                    $("#toLabel_r").attr('id', "toLabel_" + numElements);

                    $("#description_r").attr('name', "description_" + numElements);
                    $("#description_r").attr('id', "description_" + numElements);

                    $("#role_r").attr('name', "role_" + numElements);
                    $("#role_r").attr('id', "role_" + numElements);

                    $("#isCurrent_r").attr('name', "isCurrent_" + numElements);
                    $("#isCurrent_r").attr('id', "isCurrent_" + numElements);

                    $("#isCurrentLabel_r").attr('for', "isCurrent_" + numElements);
                    $("#isCurrentLabel_r").attr('id', "isCurrentLabel_" + numElements);

                    $("#addedDiv_r").attr('id', "addedDiv_" + numElements);
                })
            });

            $('#deleteButton').on('click', function(){
                $("#addedDiv_" + numElements).replaceWith("<div id='replaceable'></div>");

                if (numElements > 1) {
                    numElements--;
                    document.getElementById('numElements').value = numElements;
                }
            })
        });
    </script>
@endsection

@section('content')

    <div style="margin-top: 30px; margin-bottom: 30px;">
        <?php ?>

        <h2>Click the "Add" Button to get started entering your work history</h2>
        @if(session('numElementsError'))
            <div class="d-flex justify-content-center col bg-danger text-white">
                <h3>{{session('numElementsError')}}</h3>
            </div>
        @endif

            <form action="{{url('/profile/' . $userID . "/workHistory")}}" method="POST" id="historyForm">
            @csrf


            @for($i = 1; $i <= session('numElements'); $i++)
            <div class="form-row">
                <div class="form-group col">
                    <label for="companyName" {{$errors->has('companyName_' . $i) ? 'style=color:red;' : ''}}>Company Name</label>
                    <input type="text"  class="{{$errors->has('companyName_' . $i) ? 'border border-danger' : ''}} form-control" id="companyName" name="companyName">
                    @if ($errors->has('companyName_' . $i))
                        <p style="color:red">{{$errors->first('companyName_' . $i)}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">
                <div class="form-group col-6">
                    <label for="from" {{$errors->has('from_' . $i) ? 'style=color:red;' : ''}}>From</label>
                    <input type="date" name="from" id="from" class="{{$errors->has('from_' . $i) ? 'border border-danger' : ''}} form-control">
                    @if ($errors->has('from_' . $i))
                        <p style="color:red">{{$errors->first('from_' . $i)}}</p>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="to" {{$errors->has('to_' . $i) ? 'style=color:red;' : ''}}>To</label>
                    <input type="date" name="to" id="to" class="{{$errors->has('to_' . $i) ? 'border border-danger' : ''}} form-control">
                    @if ($errors->has('to_' . $i))
                        <p style="color:red">{{$errors->first('to_' . $i)}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">
                <div class="form-group col">
                    <label for="role" {{$errors->has('role_' . $i) ? 'style=color:red;' : ''}}>Role</label>
                    <input type="text" name="role" id="role" class="{{$errors->has('role_' . $i) ? 'border border-danger' : ''}} form-control">
                    @if ($errors->has('role_' . $i))
                        <p style="color:red">{{$errors->first('role_' . $i)}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">
                <div class="form-group col">
                    <label for="description" {{$errors->has('description_' . $i) ? 'style=color:red;' : ''}}>Description</label>
                    <textarea name="description" id="description" rows="3" class="{{$errors->has('description_' . $i) ? 'border border-danger' : ''}} form-control"></textarea>
                    @if ($errors->has('description_' . $i))
                        <p style="color:red">{{$errors->first('description_' . $i)}}</p>
                    @endif
                </div>
            </div>



            <div class="form-row">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="1" id="isCurrent">
                    <label for="isCurrent" class="form-check-label">I Currently Work Here</label>
                </div>
            </div>
            <br/><br/><br/>

            @endfor


            <div id="replaceable"></div>
            <input type="hidden" value="0" name="numElements" id="numElements">
        </form>
    </div>


    <button id="deleteButton" class=" btn button">Delete Last History</button>
    <button id="submitButton" form="historyForm" class=" btn button">Move on to Education History</button>
    <button id="addButton" class="btn button">Add</button>


@endsection


