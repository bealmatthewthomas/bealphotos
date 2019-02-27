<form action="{{route('photo_store')}}" method="POST"  enctype="multipart/form-data">
    @csrf
    <label for="photo[title]">Title</label>
    <input type="text" id="photo[title]" name="photo[title]">

    <label for="photo[description]">Description</label>
    <input type="text" id="photo[description]" name="photo[description]">

    <label for="photo[file]">Photo</label>
    <input type="file" id="photo[file]" name="photo[file]">

    <button type="submit">Submit</button>
</form>