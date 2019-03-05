@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1 class="text-center">{{$viewdata['models']['vacation']->title}}</h1>
                        <p>{{$viewdata['models']['vacation']->description}}</p>
                        <a href="{{route('photo_create', ['vacation_id' => $viewdata['models']['vacation']->id])}}">Add a Photo</a>
                        @foreach($viewdata['models']['vacation']->photos()->get() as $photo)
                            <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
