@extends('admin.master')

@section('header')
    <br/>
    <h2 style="text-indent: 25px"> {{ $topic->name }} questions </h2>
@endsection

@section('content')

<script>

    $(document).ready(function()
    {
        $('.answer-button').on('click', function ()
        {
            $('#answerForm').find('input[name="question_id"]').val($(this).data('question-id'));

            var answerText = $(this).data('answer-text');

            $('#answerForm').find('textarea[name="answer_text"]').val(answerText);
        });

        $('.question-button').on('click', function ()
        {
            $('#editQuestionForm').find('input[name="question_id"]').val($(this).data('question-id'));
            $('#editQuestionForm').find('textarea[name="question_text"]').val($(this).data('question-text'));
            $('#editQuestionForm').find('input[name="author_name"]').val($(this).data('author-name'));
            $('#editQuestionForm').find('input[name="author_email"]').val($(this).data('author-email'));
            $('#editQuestionForm').find('input[name="is_hidden"]').prop('checked', $(this).data('is-hidden'));
        });
    });

</script>

    <div class="cd-faq-items">
        <ul id="questions" class="cd-faq-group">

            @foreach ($questions as $question)
                <li>
                    <a class="cd-faq-trigger" style="text-decoration: {{ $question->is_hidden ? 'line-through' : 'none' }} " href="#0">{{$question->question_text}}
                    </a>

                    <div class="cd-faq-content">

                        <b>Answer: </b>{{ $question->answer->answer_text or null }}

                        <ul>
                            <li><b>Author: </b> {{$question->author_name}}</li>
                            <li><b>Author EMail: </b> {{$question->author_email}}<li/>
                        </ul>

                        <br/>

                        <button type="button" class="btn btn-primary question-button" data-toggle="modal"
                                data-target="#editQuestionModal"
                                data-question-id="{{ $question->id }}"
                                data-question-text="{{ $question->question_text}}"
                                data-author-name="{{ $question->author_name}}"
                                data-author-email="{{ $question->author_email}}"
                                data-is-hidden="{{ $question->is_hidden}}"
                        >Edit
                            <span class="glyphicon glyphicon-new"></span>
                        </button>

                        <button type="button" class="btn btn-primary answer-button" data-question-id="{{$question->id}}" data-answer-text="{{$question->answer->answer_text or null}}" data-toggle="modal" data-target="#answerModal">
                        @if (isset($question->answer->answer_text))
                            Edit answer
                        @else
                            Post answer
                        @endif
                        <span class="glyphicon glyphicon-new"></span>
                        </button>

                        {{ Form::open(['route' => ['topicquestions.destroy', $topic->id], 'style' => 'display:inline'])}}

                        @csrf
                        {{ method_field('DELETE') }}

                        <input type="hidden" name="question_id" value="{{$question->id}}"/>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>

                        {{ Form::close() }}


                    </div>
                </li>

            @endforeach
        </ul> <!-- cd-faq-group -->
    </div>

    <div class="modal fade in" id="answerModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Answer for question</h4>
                </div>

                <div class="modal-body">

                    {{ Form::open(['route' => ['topicquestions.answer', $topic->id], 'method' => 'PUT', 'id' => 'answerForm' ] ) }}

                    <div class="col-md-9">
                        <label for="name" class="control-label">Post your answer</label>
                        <div>
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <textarea rows="5" cols="60" id="answer_text" name="answer_text" placeholder="Answer"></textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="question_id" value=""/>

                    {{ Form::close() }}

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" form="answerForm">Post</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade in" id="editQuestionModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Question details</h4>
                </div>

                <div class="modal-body">

                    {{ Form::open(['route' => ['topicquestions.update', $topic->id], 'method' => 'PUT', 'id' => 'editQuestionForm' ] ) }}

                    <div class="col-md-9">
                        <label for="topic">{{ __('Topic')}}</label>

                        <select name="new_topic_id">
                            <option disabled>Choose a topic ... </option>
                            @foreach ($topics as $topicForSelect)
                                <option value="{{$topicForSelect->id}}" {{ $topicForSelect->id == $topic->id ? 'selected' : '' }}  }} >{{$topicForSelect->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-9">
                        <label for="name" class="control-label">Question text</label>
                        <div>
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <textarea rows="5" cols="60" id="question_text" name="question_text" placeholder="Question text"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">

                        <label for="author_name" class="control-label">Author</label>
                        <input type="text" name="author_name"  /><br/>
                        <label for="author_email" class="control-label">Author E-Mail</label>
                        <input type="email" name="author_email"/><br/>
                        <label for="is_hidden" class="control-label">Hidden</label>
                        <input type="checkbox" name="is_hidden"/>

                    </div>

                    <input type="hidden" name="question_id" value=""/>
                    <input type="hidden" name="topic_id" value= "{{$topic->id}}"/>

                    {{ Form::close() }}

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" form="editQuestionForm">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <br/>
    <br/>

@endsection