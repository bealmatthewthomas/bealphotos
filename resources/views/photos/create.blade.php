<form action="{{route('photo_store')}}" method="POST">
    {{csrf_field()}}
    <label for="photo[name]">Name</label>
    <input type="text" id="photo[name]" name="photo[name]">

    <label for="photo[description]">Description</label>
    <input type="text" id="photo[description]" name="photo[description]">

    <label for="photo[file]">Photo</label>
    <input type="file" id="photo[file]" name="photo[file]">

    <button type="submit">Submit</button>
</form>