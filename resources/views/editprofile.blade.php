@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
<div style="color:white">
    <br>
    <h1>Edit Profile</h1>
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class='form-group'>
        {{Form::label('work', 'Work')}}
        {{Form::text('work', $user->work, ['class' => 'form-control', 'placeholder' => 'Work or study institution'])}}
    </div>
    <div class='form-group'>
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $user->description, ['class' => 'form-control', 'placeholder' => 'Description', 'cols' => '15', 'rows' => '3'])}}
    </div>

    <p style="font-size:20px" >Profile picture<p>
    <div clas="form-group">
        
        {{Form::file('cover_img')}}
    </div>
    <br>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}} <br><br>
    {!! Form::close() !!} 
</div>      
@endsection