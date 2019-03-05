@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div>
                        @if(!empty($errors->first()))
                            <div class="row col-lg-12">
                                <div class="alert alert-danger">
                                    <span>{{ $errors->first() }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <form action="{{route('vacation_store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <label for="vacation[title]">Title</label>
                        <input class ='form-control' type="text" id="vacation[title]" name="vacation[title]" value ='{{old('vacation.title')}}' required>
                        <br>
                        <label for="vacation[description]">Description</label>
                        <textarea type="text" class="form-control" id="vacation[description]" name="vacation[description]" required>{{old('vacation.description')}}</textarea>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection