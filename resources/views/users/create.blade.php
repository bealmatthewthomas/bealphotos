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
                        <label for="user[name]">Name</label>
                        <input class ='form-control' type="text" id="user[name]" name="user[name]" value ='{{old('user.name')}}' required>
                        <br>
                        <label for="user[email]">Email</label>
                        <input type="text" class="form-control" id="user[email]" name="user[email]" value ='{{old('user.email')}}' required>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection