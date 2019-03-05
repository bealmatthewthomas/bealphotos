@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <h1 class="text-center">Vacations</h1>
                        @if(!empty(session('message')))
                            <p>{{session('message')}}</p>
                        @endif
                        @foreach($viewdata['models']['vacations'] as $vacation)
                            <h3>{{$vacation->title}}</h3>
                            <p>{{$vacation->description}}</p>
                            @foreach($vacation->photos as $photo)
                                <p><img class="img-fluid" src="https://s3.amazonaws.com/bealvacations/{{$photo->url}}"></p>
                            @endforeach
                            <p>Uploaded: {{$vacation->created_at}}</p>
                            <a href="{{route('vacation_view', ['vacation_id' => $vacation->id])}}">View</a>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
