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
                    <h2 class="text-center">Create a Photo</h2>
                    <form action="{{route('photo_store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <label for="photo[title]">Title</label>
                        <input class ='form-control' type="text" id="photo[title]" name="photo[title]" value ='{{old('photo.title')}}' >
                        <br>
                        <label for="photo[description]">Description</label>
                        <textarea type="text" class="form-control" id="photo[description]" name="photo[description]">{{old('photo.description')}}</textarea>
                        <br>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo[file]" name="photo[file]">
                            <label class="custom-file-label" for="photo[file]">Choose photo</label>
                        </div>
                        <br>
                        <label for="album[id]">Choose an Album</label>
                        <select class='form-control' id="album[id]" name="album[id]" @if($viewdata['data']['album_default']) disabled @endif>
                            @if($viewdata['data']['album_default'])<option value="">No Album</option>@endif
                            @foreach($viewdata['models']['albums'] as $album)
                                <option value="{{$album->id}}">{{$album->title}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection