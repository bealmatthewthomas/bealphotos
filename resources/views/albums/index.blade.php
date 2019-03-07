@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="text-center">
                            <h2>Albums</h2>
                            <a href="{{route('album_create')}}">Create new Album</a>
                        </div>
                        @if(!empty(session('message')))
                            <p>{{session('message')}}</p>
                        @endif
                        <div class="row">
                            @foreach($viewdata['models']['albums'] as $album)
                                <div class="col-md-6 col-sm-12">
                                    <h3 class="text-center">{{$album->title}}</h3>
                                    @foreach($album->photos()->take(4)->get() as $photo)
                                        <div class="col-md-6">
                                            <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                                        </div>
                                    @endforeach
                                    <a href="{{route('album_view', ['album_id' => $album->id])}}">View</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
r