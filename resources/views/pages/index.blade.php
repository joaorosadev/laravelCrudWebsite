@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <div class ="jumbotron text-center" style="position:relative; top:100px;">
        <h1 style="font-size: 300%;">Welcome to Scientific Papers</h1>
        <h2 style="font-size: 200%;">A scientific research papers database</h2>
        <br>
        <p  style="font-size: 150%;">Login or Register to be able to acess the platform</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection


