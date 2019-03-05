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
                    <form action="{{route('photo_store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <label for="photo[title]">Title</label>
                        <input class ='form-control' type="text" id="photo[title]" name="photo[title]" value ='{{old('photo.title')}}' required>
                        <br>

                        <label for="photo[description]">Description</label>
                        <textarea type="text" class="form-control" id="photo[description]" name="photo[description]" required>{{old('photo.description')}}</textarea>
                        <br>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo[file]" name="photo[file]">
                            <label class="custom-file-label" for="photo[file]">Choose photo</label>
                        </div>
                        <br>

                        <label for="photo[vacation_id]">Vacation</label>
                        <select class="form-control" id="photo[vacation_id]" name="photo[vacation_id]">
                            @foreach($viewdata['models']['vacations'] as $vacation)
                                <option value ='{{$vacation->id}}' selected>{{$vacation->title}}</option>
                            @endforeach
                        </select>
                        <br>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection