@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="text-center">
                            <h1>User</h1>
                            <h3>{{$viewdata['models']['user']->name}}</h3>
                            <p>{{$viewdata['models']['user']->username}}</p>
                            <a href="{{route('user_edit', [])}}"
                        </div>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
