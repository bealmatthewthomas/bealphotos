@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1 class="text-center">Photos</h1>
                        @if(!empty(session('message')))
                            <p>{{session('message')}}</p>
                        @endif
                        @foreach($viewdata['models']['photos'] as $photo)
                            <h3>{{$photo->title}}</h3>
                            <a href="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></a>
                            <p>{{$photo->description}}</p>
                            <p>{{$photo->user()->first()->name}}</p>
                            <p>Uploaded: {{$photo->created_at}}</p>
                            <a href="{{route('photo_view', ['photo_id' => $photo->id])}}">View</a>
                            @if(!empty($viewdata['models']['user']->id))
                                @if($viewdata['policies']['photo']->delete($viewdata['models']['user'],$photo))
                                    <form action="{{ route('photo_delete', ['photo_id' => $photo->id]) }}" method="POST" onsubmit="return confirm('Delete photo: {{ $photo->name }}?');">
                                        @csrf
                                        <input class = 'btn btn-danger' type="submit" value="Delete">
                                    </form>
                                @endif
                            @endif
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
