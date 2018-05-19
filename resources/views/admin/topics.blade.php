@extends('admin.master')

@section('header')
    <h1 style="text-indent: 25px">Question topics summary</h1>
@endsection

@section('content')

    @if (count($topics) > 0)
        <table name="Topics" class="table table-dark">
            <thead class="thead-dark">
                <tr>
                        <th scope="row">Name</th>
                        <th scope="row">Total questions</th>
                        <th scope="row">Answered</th>
                        <th scope="row">Awaiting answer</th>
                        <th scope="row">Hidden</th>
                        <th scope="row"></th>
                        <th scope="row"></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($topics as $topic)
                    <tr>
                        <td> {{ $topic->name }} </td>
                        <td> {{ $topic->totalCount() }} </td>
                        <td> {{ $topic->answeredCount() }} </td>
                        <td> {{ $topic->unAnsweredCount() }} </td>
                        <td> {{ $topic->hiddenCount() }} </td>

                        <td>
                        {{ Form::open(['route' => ['topics.edit', $topic], 'style' => 'display:inline', 'method'=>'GET'] ) }}
                            @csrf
                            <button type="submit" class="btn btn-primary">Details</button>
                        {{ Form::close() }}
                        </td>

                        @php
                            $onSubmit = "return confirm('Are you sure you want to delete ".$topic->name." with all questions?');";
                        @endphp

                        <td>
                        {{ Form::open(['route' => ['topics.destroy', $topic->id], 'style' => 'display:inline', 'onsubmit' => $onSubmit])}}

                            @csrf
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>

                        {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>    

    @else

        <p> The topic list is empty </p>

    @endif

    <div class="modal fade in" id="newTopicModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New topic</h4>
                </div>

                <div class="modal-body">

                    {{ Form::open(['route' => ['topics.store'], 'method' => 'POST', 'id' => 'newTopic' ] ) }}

                    <div class="col-md-9">
                        <label for="name" class="control-label">New topic name</label>
                        <div>
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Topic name">
                            </div>
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" form="newTopic">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTopicModal">New topic<span class="glyphicon glyphicon-new"></span></button>



@endsection