@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <br>
    <h1 style="color:white">Submit Paper</h1>
    {!! Form::open(['action' => 'PapersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div style="color:white">
    <div class='form-group'>
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class='form-group'>
        {{Form::label('type', 'Type: ')}}
        {{Form::select('type', ['Revistas científicas' => 'Revistas científicas', 'Livros publicados' => 'Livros publicados', 'Capítulos em livros' => 'Capítulos em livros', 'Conferências internacionais' => 'Conferências internacionais', 'Conferências nacionais' => 'Conferências nacionais', 'Relatórios académicos' => 'Relatórios académicos', 'Eventos internacionais' => 'Eventos internacionais', 'Eventos nacionais' => 'Eventos nacionais', 'Outros media' => 'Outros media'], null, ['placeholder' => '<option>'])}}
    </div>
    <div class='form-group'>
        {{Form::label('abstract', 'Abstract')}}
        {{Form::textarea('abstract', '', ['class' => 'form-control', 'placeholder' => 'Abstract', 'cols' => '20', 'rows' => '5'])}}
    </div>
    <div class='form-group'>
            {{Form::label('keywords', 'Keywords')}}
            {{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Keywords'])}}
    </div>
    <div class='form-group'>
        {{Form::label('body', 'Comments')}}
        {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Comments', 'cols' => '20', 'rows' => '3'])}}
    </div>
    <div clas="form-group">
            {{Form::file('cover')}}
    </div>
    <br>
    </div>
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}} <br><br>
    {!! Form::close() !!}       
@endsection