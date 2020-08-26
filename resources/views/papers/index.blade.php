<?php use App\User; ?>

@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
    <br>
    <h1 style="color:white;">Papers</h1>
    <br>
    @if(count($papers)>0)
        @foreach($papers as $paper)
            <div class="jumbotron" style="padding:0.5em 0.6cm;">
                <h3><a href="/papers/{{$paper->id}}"> {{$paper->title}} </a></h3>
                               
                <?php
                    $user1 = User::where('name','LIKE','%'.$paper->user->name.'%')->first();
                    $uid = $user1->id;
                ?>

                <small>Uploaded on {{$paper->created_at}}.</small><br><small>Author: <a href="/profile/{{$uid}}">{{$paper->user->name}}</a></small>
            </div>
        @endforeach
        {{$papers->links()}}
    @else
        <p style="color: white">No Papers found.</p>
    @endif
@endsection