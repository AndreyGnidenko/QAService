@extends('adminMaster')

@section('header')
    <h1 style="text-indent: 25px">QA service administrators</h1>
@endsection

@section('content')

       <ul class="list-group">

            @foreach ($admins as $admin)
                <li class="list-group-item list-group-item-success">{{ $admin->login }}
                    <span class="float-right button-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{$admin->id}}">
                        <span class="glyphicon glyphicon-edit"></span> Change password</button>

                     @if (Auth::user()->id != $admin->id)

                     @php
                        $confirmText = "return confirm('Are you sure you want to delete ".$admin->login."?');";
                     @endphp

                     {{ Form::open(['route' => ['admins.destroy', $admin->id], 'style' => 'display:inline', 'onsubmit' => $confirmText] ) }}

                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>

                     {{ Form::close() }}

                     @endif

                    </span>
                </li>

                <div class="modal fade in" id="myModal_{{$admin->id}}" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Change {{$admin->login}} password </h4>
                            </div>

                            <div class="modal-body">

                            {{ Form::model($admin, ['route' => ['admins.update', $admin->id], 'class' => 'myclass', 'id' => $admin->id ] ) }}

                                {{ method_field('PUT') }}

                                <div class="col-md-9">
                                    <label for="current-password" class="control-label">Current Password</label>
                                    <div>
                                        <div class="form-group">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
                                        </div>
                                    </div>
                                    <label for="password" class="control-label">New Password</label>
                                    <div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="new-password" placeholder="Password">
                                        </div>
                                    </div>
                                    <label for="password_confirmation" class="control-label">Re-enter Password</label>
                                    <div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password_confirmation" name="new-password_confirmation" placeholder="Re-enter Password">
                                        </div>
                                    </div>
                                </div>

                            {{ Form::close() }}

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" form="{{$admin->id}}">Change</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

            @endforeach
        </ul>

    <div class="modal fade in" id="newModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New login</h4>
                </div>

                <div class="modal-body">

                    {{ Form::model($admin, ['route' => ['admins.store'], 'method' => 'POST', 'id' => 'newAdmin' ] ) }}

                    <div class="col-md-9">
                        <label for="login" class="control-label">New login</label>
                        <div>
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" class="form-control" id="login" name="login" placeholder="Password">
                            </div>
                        </div>
                        <label for="password" class="control-label">Password</label>
                        <div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <label for="password_confirmation" class="control-label">Re-enter Password</label>
                        <div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                            </div>
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" form="newAdmin">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <br/>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal">New administrator<span class="glyphicon glyphicon-new"></span></button>

@endsection