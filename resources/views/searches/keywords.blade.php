@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <div class ="jumbotron text-center" style="position:relative; top:130px;">
        {!! Form::open(['action' => 'SearchesController@keywordsHandler', 'method' => 'GET']) !!}
            <div class='form-group'>
                    {{Form::label('keywords', 'Keywords', ['style' => 'font-size: 30px'])}}
                    {{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Keywords to search for', 'style' => 'text-align: center'])}}
            </div>
            {{Form::submit('Search',['class' => 'btn btn-primary'])}} <br><br>
        {!! Form::close() !!}
    </div>
@endsection