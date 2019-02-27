<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //if request has file ( todo replace this with validation)
        if($request->hasFile('photo.file')) {
            $image = $request->file('photo.file');
        }
        else{
            redirect()
                ->back();
        }
        $photo = new Photo($request->input('photo'));
        
        $storagePath = Storage::disk('s3')->put("photos", $image, 'public');
        $photo->setAttribute('url', $storagePath);
        $photo->save();

        return redirect(route('photos_index'));
    }
}
