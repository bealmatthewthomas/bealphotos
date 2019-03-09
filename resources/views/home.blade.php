@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Welcome {{$viewdata['models']['user']->name}}</h2>
                            @if(empty($viewdata['models']['user']->photos()))
                                <p>You don't have any photos!</p>
                                <a href="{{route('photo_create')}}">Create One?</a>
                            @else
                                <p>Here are your photos</p>
                            @endif
                            @foreach($viewdata['models']['user']->photos()->get() as $photo)
                                <p>{{$photo->title}}</p>
                                <p><img class="img-fluid" src="https://s3.amazonaws.com/bealphotos/{{$photo->url}}"></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
