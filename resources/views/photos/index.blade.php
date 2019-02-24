<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

</head>
<body>
<div class="flex-center position-ref full-height">
   <h1>Photos</h1>
    @foreach($photos as $photo)
        <p>{{$photo->title}}</p>
        <p>{{$photo->url}}</p>
        <p>{{$photo->description}}</p>
    @endforeach
</div>
</body>
</html>
