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
                    <h2 class="text-center">Create New User</h2>
                    <form action="{{route('user_store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <label for="user[title]">Title</label>
                        <input class ='form-control' type="text" id="user[title]" name="user[title]" value ='{{old('user.title')}}' required>
                        <br>
                        <label for="user[description]">Description</label>
                        <textarea type="text" class="form-control" id="user[description]" name="user[description]" required>{{old('user.description')}}</textarea>
                        <br>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection