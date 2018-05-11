@extends('adminMaster')

@section('content')
    @if (count($topics) > 0)
        <table name="Topics" class="table table-dark">
            <thead class="thead-dark">
                <tr>
                        <th scope="row">Name</th>
                        <th scope="row">Total questions</th>
                        <th scope="row">Answered</th>
                        <th scope="row">Awaiting answer</th>
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


                        <form id="edit_form" action="{{ route('topics.edit', $topic) }}" method="GET" style="display: none;">
                            @csrf
                            <td>
                                <button type="button" class="btn btn-primary">Edit</button>
                            </td>
                        </form>

                        <form id="delete_form" method="POST" action="{{ url('/topics', $topic->id) }}", style="display: none;">

                            @csrf
                            {{ method_field('DELETE') }}
                            <td>
                            <input type="submit" class="btn btn-primary" value="Delete"></input>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>    

    @else

        <p> The topic list is empty </p>

    @endif

    <form id="new_form" action="{{ route('topics.create') }}" method="GET" style="display: none;">
        @csrf

    </form>

    <button type="submit" form="new_form" class="btn btn-primary">New topic</button>

@endsection