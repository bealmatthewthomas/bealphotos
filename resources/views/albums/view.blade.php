@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1>Photos</h1>
                        <h3>{{$viewdata['models']['album']->title}}</h3>
                        <p><img class="img-fluid" src="https://s3.amazonaws.com/bealalbums/{{$viewdata['models']['album']->url}}"></p>
                        <p>{{$viewdata['models']['album']->description}}</p>
                        <p>Uploaded: {{$viewdata['models']['album']->created_at}}</p>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
