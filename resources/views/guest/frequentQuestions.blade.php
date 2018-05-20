@extends('guest.master')

@section('header')
    <br/>
    <h2 style="text-indent: 25px"> Frequently asked questions </h2>
@endsection

@section('content')
    @include('shared.questionsByTopics')
@endsection

@section('footer')

    <a class="btn btn-primary" href="{{ route('questions.faqCreate') }}"> Ask a question</a>

    <br/>
    <br/>
    <br/>

 @endsection('footer')