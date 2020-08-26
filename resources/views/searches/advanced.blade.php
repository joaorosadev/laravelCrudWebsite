@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <div style="position:absolute; top: 150px; width: 1000px; left: 280px" class ="jumbotron text-center" style="position:relative; top:130px;">
        {!! Form::open(['action' => 'SearchesController@advancedHandler', 'method' => 'GET']) !!}
        <div class='form-group'>
            {{Form::label('title', 'Title', ['style' => 'font-size: 30px'])}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title to search for', 'style' => 'text-align: center'])}}
        </div>    
        <div class='form-group'>
                    {{Form::label('author', 'Author', ['style' => 'font-size: 30px'])}}
                    {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author to search for', 'style' => 'text-align: center'])}}
            </div>
            <div class='form-group'>
                {{Form::label('keywords', 'Keywords', ['style' => 'font-size: 30px'])}}
                {{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Keywords to search for', 'style' => 'text-align: center'])}}
        </div>
            {{Form::submit('Search',['class' => 'btn btn-primary'])}} <br><br>
        {!! Form::close() !!}
    </div>
@endsection