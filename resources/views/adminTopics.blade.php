@extends('adminMaster')

@section('content')
    @if (count($topics) > 0)
        <table name="Topics" class="table table-dark">
            <thead class=="thead-dark">
                <tr>
                        <th scope="row">Name</th>
                        <th scope="row">Total questions</th>
                        <th scope="row">Answered</th>
                        <th scope="row">Awaiting answer</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($topics as $topic)
                    <tr>    
                        <td> {{ $topic->name }} </td>
                        <td> {{ $topic->totalCount() }} </td>
                        <td> {{ $topic->answeredCount() }} </td>
                        <td> {{ $topic->unAnsweredCount() }} </td>
                        <!--
                        <td> {{ $topic->answeredQuestions }} </td>
                        <td> {{ $topic->unansweredQuestions }} </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>    

    @endif
@endsection