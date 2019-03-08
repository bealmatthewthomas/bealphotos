@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1>Photo</h1>
                        <h3>{{$viewdata['models']['photo']->title}}</h3>
                        <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$viewdata['models']['photo']->url}}"></p>
                        <p>{{$viewdata['models']['photo']->description}}</p>
                        <p>{{$viewdata['models']['photo']->user()->first()->name}}</p>
                        <p>Uploaded: {{$viewdata['models']['photo']->created_at}}</p>
                        @if(!empty($viewdata['models']['user']->id))
                            @if($viewdata['policies']['photo']->delete($viewdata['models']['user'],$viewdata['models']['photo']))
                                <form action="{{ route('photo_delete', ['photo_id' => $viewdata['models']['photo']->id]) }}" method="POST" onsubmit="return confirm('Delete photo: {{ $viewdata['models']['photo']->name }}?');">
                                    @csrf
                                    <input class = 'btn btn-danger' type="submit" value="Delete">
                                </form>
                            @endif
                        @endif
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
