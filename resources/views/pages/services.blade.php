@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('body')
    <h1>Welcome to the Services page</h1>
    @if(count($services) > 0)
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
    
        </ul>
    @endif
@endsection
