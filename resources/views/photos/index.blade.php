@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <nav>
                        <ul>
                            <li><a href="{{route('photos_index')}}">View All Photos</a></li>
                            <li><a href="{{route('photo_create')}}">Create New Photo</a></li>
                        </ul>
                    </nav>
                    <div class="flex-center position-ref full-height">
                        <h1>Photos</h1>
                        @foreach($photos as $photo)
                            <p>{{$photo->title}}</p>
                            <p><img src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                            <p>{{$photo->description}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
