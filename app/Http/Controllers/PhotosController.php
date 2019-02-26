<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

/**
 * Class PhotosController
 * @package App\Http\Controllers
 * @author mattbeal
 */
class PhotosController extends Controller
{
    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $photos = Photo::all();
        return view('photos.index', ['photos' => $photos]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        // Create temp file
        $file = $request->file('photos.image');
        dd($file);

    }
}
