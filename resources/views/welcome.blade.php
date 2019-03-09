@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center">Welcome to Beal Photos!</h2>

                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h3 class="text-center">Take a look at our albums!</h3>
                                @foreach($viewdata['models']['albums'] as $album)
                                    <div class="col-md-6 col-sm-12">
                                        <h3 class="text-center">{{$album->title}}</h3>
                                        <div class="row">
                                            @foreach($album->photos()->take(4)->get() as $photo)
                                                <div class="col-md-6">
                                                    <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                                                </div>
                                            @endforeach
                                        </div>

                                        <a href="{{route('album_view', ['album_id' => $album->id])}}">View</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
