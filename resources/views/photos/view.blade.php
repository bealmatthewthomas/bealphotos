@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1>Photos</h1>
                        <h3>{{$photo->title}}</h3>
                        <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                        <p>{{$photo->description}}</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
