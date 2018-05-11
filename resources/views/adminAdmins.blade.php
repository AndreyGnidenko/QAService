@extends('adminMaster')

@section('content')

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <script>
        $("#edit").click(function() {
            $("#text-edit").val($("#text-source").val());
            $("#edit-popup").dialog({
                height: 400,
                width: 600,
                modal: true,
                buttons: {
                    "Close": function () {
                        $("#text-source").val($("#text-edit").val());
                        $(this).dialog("close");
                    }
                }
            });
        });
    </script>

    <div class="container">
        <ul class="list-group">

            @foreach ($admins as $admin)
                <li class="list-group-item clearfix">
                    {{ $admin->login }}
                    <span class="float-right button-group">
                     <button type="button" class="btn btn-primary"><span id="btn" class="glyphicon glyphicon-edit"></span> Edit</button>
                     <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("btn");

        //btn.hide();

        alert(btn.className);

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {

            alert('aaa');

            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



@endsection