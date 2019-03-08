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
                        @foreach($viewdata['models']['users'] as $user)
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->username}}</p>
                            <a href="{{route('user_view')}}">View</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
