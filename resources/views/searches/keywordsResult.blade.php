@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <br>
<h1 style="color:white;">Search results for "{{$keywords}}" (Keywords):</h1>
    <br>
    @if(count($papers)>0)
        @foreach($papers as $paper)
            <div class="jumbotron" style="padding:0.5em 0.6cm;">
                <h3><a href="/papers/{{$paper->id}}"> {{$paper->title}} </a></h3>
                <small>Uploaded on {{$paper->created_at}}.</small><br><small>Author: {{$paper->user->name}}</small>
            </div>
        @endforeach
    @else
        <p style="color:white;">No Papers found.</p>
    @endif
@endsection