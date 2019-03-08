@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="text-center">
                            <h1>User</h1>
                            <form action="{{route('user_save', ['user_id' => $viewdata['models']['user']->id])}}" method = 'POST' >
                                @csrf
                                <h3>{{$viewdata['models']['user']->name}}</h3>
                                <p>{{$viewdata['models']['user']->email}}</p>
                                <label for="user[name]">Name</label>
                                <input class ='form-control' id="user[name]" name="user[name]" value="{{$viewdata['models']['user']->name}}" required>

                                <label for="user[email]">Email</label>
                                <input class ='form-control' id="user[email]" name="user[email]" value="{{$viewdata['models']['user']->email}}" required>

                                <label for="user[password]">Password (leave empty for no change)</label>
                                <input class ='form-control' id="user[password]" name="user[password]" value="">

                                <label for="roles[id]">Roles</label>
                                <select multiple class ='form-control' id="roles[id]" name="roles[id]">
                                    @foreach($viewdata['data']['roles'] as $role)
                                        <option value="{{$role->id}}" @if($role->user_has_role) selected @endif>{{$role->title}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
