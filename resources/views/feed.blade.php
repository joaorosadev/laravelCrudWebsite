@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')

@foreach($user->users as $user)

    <h1>{{$user->name}}</h1> <br>

@endforeach

@endsection