@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
<div style="color:white">
    <br>
    <h1>Edit Paper</h1>
    {!! Form::open(['action' => ['PapersController@update', $paper->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class='form-group'>
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $paper->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class='form-group'>
        {{Form::label('type', 'Type: ')}}
        {{Form::select('type', ['Revistas científicas' => 'Revistas científicas', 'Livros publicados' => 'Livros publicados', 'Capítulos em livros' => 'Capítulos em livros', 'Conferências internacionais' => 'Conferências internacionais', 'Conferências nacionais' => 'Conferências nacionais', 'Relatórios académicos' => 'Relatórios académicos', 'Eventos internacionais' => 'Eventos internacionais', 'Eventos nacionais' => 'Eventos nacionais', 'Outros media' => 'Outros media'], null, ['placeholder' => '<option>'])}}
    </div>
    <div class='form-group'>
        {{Form::label('abstract', 'Abstract')}}
        {{Form::textarea('abstract', $paper->abstract, ['class' => 'form-control', 'placeholder' => 'Abstract', 'cols' => '20', 'rows' => '5'])}}
    </div>
    <div class='form-group'>
            {{Form::label('keywords', 'Keywords')}}
            {{Form::text('keywords', $paper->keywords, ['class' => 'form-control', 'placeholder' => 'Keywords'])}}
    </div>
    <div class='form-group'>
        {{Form::label('body', 'Comments')}}
        {{Form::textarea('body', $paper->body, ['class' => 'form-control', 'placeholder' => 'Body', 'cols' => '20', 'rows' => '3'])}}
    </div>
    <div clas="form-group">
        {{Form::file('cover')}}
    </div>
    <br>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}} <br><br>
    {!! Form::close() !!} 
</div>      
@endsection