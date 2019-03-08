@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1>Users</h1>
                        @if(!empty(session('message')))
                            <p>{{session('message')}}</p>
                        @endif
                        <a href="{{route('user_create')}}">Create a User</a>
                        @foreach($viewdata['models']['users'] as $user)
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->email}}</p>
                            <a href="{{route('user_edit', ['user_id' => $user->id])}}">Edit</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
