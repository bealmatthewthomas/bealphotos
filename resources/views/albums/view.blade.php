@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1>Photos</h1>
                        <h3>{{$viewdata['models']['album']->title}}</h3>
                        <p>{{$viewdata['models']['album']->description}}</p>
                        @foreach($viewdata['models']['album']->photos()->get() as $photo)
                            <h3>{{$photo->title}}</h3>
                            <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                            <p>{{$photo->description}}</p>
                            <p>{{$photo->user()->first()->name}}</p>
                            <p>Uploaded: {{$photo->created_at}}</p>
                            <a href="{{route('photo_view', ['photo_id' => $photo->id])}}">View</a>
                            <hr>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
