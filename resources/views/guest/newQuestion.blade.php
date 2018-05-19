@extends('guest.master')

@section('header')
    <br/>
    <h2 style="text-indent: 25px"> New question </h2>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('questions.faqStore') }}" style="display:inline">
                        @csrf

                        <div class="col-md-9">
                            <label for="topic">{{ __('Topic')}}</label>

                            <select name="topic_id">
                                <option disabled>Choose a topic ... </option>
                                @foreach ($topics as $topic)
                                    <option value="{{$topic->id}}">{{$topic->name}}</option>
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
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post') }}
                                </button>
                                <a class="btn btn-primary" href="{{ route('guest') }}">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection