@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="text-center">
                            <h1>Photos</h1>
                            <h3>{{$viewdata['models']['album']->title}}</h3>
                            <p>{{$viewdata['models']['album']->description}}</p>
                            <a href="{{route('photo_create', ['album_id' => $viewdata['models']['album']->id])}}">Add a Photo to this Album</a>
                        </div>
                        @foreach($viewdata['models']['album']->photos()->get()->sortByDesc('created_at') as $photo)
                            <h3>{{$photo->title}}</h3>
                            <a href="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></a>
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
