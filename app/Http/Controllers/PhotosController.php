<?php

namespace App\Http\Controllers;

use App\Photo;

class PhotosController extends Controller
{
    //
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', ['photos' => $photos]);
    }
}
