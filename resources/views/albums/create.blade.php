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
                    <h2 class="text-center">Create New Album</h2>
                    <form action="{{route('album_store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <label for="album[title]">Title</label>
                        <input class ='form-control' type="text" id="album[title]" name="album[title]" value ='{{old('album.title')}}' required>
                        <br>
                        <label for="album[description]">Description</label>
                        <textarea type="text" class="form-control" id="album[description]" name="album[description]" required>{{old('album.description')}}</textarea>
                        <br>
                        <label for="category[id]">Album Category</label>
                        <select class='form-control' id="category[id]" name="category[id]">
                            <option value="">None</option>
                            @foreach($viewdata['models']['categories'] as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection