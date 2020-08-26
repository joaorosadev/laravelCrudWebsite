@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
@endsection

@section('body')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/papers/create" class="btn btn-primary">Create Paper</a> <br> <hr>
                    <h3>Your Papers</h3>
                    @if(count($papers)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($papers as $paper)
                            <tr>
                            <td>{{$paper->title}}</td>
                                <td><a href="/papers/{{$paper->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PapersController@destroy', $paper->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no submitted papers</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
