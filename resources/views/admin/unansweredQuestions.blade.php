@extends('admin.master')

@section('header')
    <br/>
    <h2 style="text-indent: 25px"> Unanswered questions </h2>
@endsection

@section('content')

    @include('shared.questionsByTopics')

@endsection