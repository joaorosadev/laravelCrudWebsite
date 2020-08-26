@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <div class ="jumbotron text-center" style="position:relative; top:130px;">
        {!! Form::open(['action' => 'SearchesController@authorHandler', 'method' => 'GET']) !!}
            <div class='form-group'>
                    {{Form::label('author', 'Author', ['style' => 'font-size: 30px'])}}
                    {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author to search for', 'style' => 'text-align: center'])}}
            </div>
            {{Form::submit('Search',['class' => 'btn btn-primary'])}} <br><br>
        {!! Form::close() !!}
    </div>
@endsection