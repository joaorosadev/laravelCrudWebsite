@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <br>
    <div style="color:white">
    <a href="/papers" class="btn btn-secondary float-right">Go Back</a> 
    <h1>{{$paper->title}}</h1>
    <div><hr style="border-color:white">
        Type: {{$paper->type}}          <br>
        Abstract: {{$paper->abstract}}  <hr style="border-color:white">
        Comments: {!!$paper->body!!}              <hr style="border-color:white">
        Keywords: {{$paper->keywords}}  
    </div>
    <small>Uploaded on {{$paper->created_at}}</small><br><small>Author: {{$paper->user->name}}</small>
    <hr style="border-color:white">
    @if(!Auth::guest())
        @if(Auth::user()->id == $paper->user_id)
            <a href="/papers/{{$paper->id}}/edit" class="btn btn-secondary">Edit</a>

            {!!Form::open(['action' => ['PapersController@destroy', $paper->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    
    <!-- FILE DOWNLOAD TESTE -->
    @if($paper->cover != 'no_file.txt')
    <a href="/download/{{$paper->cover}}" class="btn btn-secondary">Download</a>
    @endif
    </div>
    <!-- TEST END -->
@endsection
