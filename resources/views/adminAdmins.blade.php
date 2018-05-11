@extends('adminMaster')

@section('content')

    <h1>QA service administrators</h1>
    
    <!--<div class="container">-->
        <ul class="list-group">

            @foreach ($admins as $admin)
                <li class="list-group-item list-group-item-success">
                    {{ $admin->login }}
                    <span class="float-right button-group">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Change password</button>
                     <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                    </span>
                </li>
            @endforeach
        </ul>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
        </div>
        
        {{ Form::model }}
        
        {{ Form::close }}
        
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
@endsection