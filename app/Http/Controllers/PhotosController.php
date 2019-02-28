<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();

        $viewdata = [
            'models' => [
                'user' => $user,
                'photos' => $photos,
            ]
        ];
        return view('photos.index', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * @author mattbeal
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * @author mattbeal
     * @param int $photo_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function view(int $photo_id)
    {
        //find photo by id and return
        $photo = Photo::find($photo_id);
        return view('photos.view', ['photo' => $photo]);
    }

    /**
     * @author mattbeal
     * @param int $photo_id
     * @throws \Exception
     * @return RedirectResponse
     */
    public function delete(int $photo_id)
    {
        /** @var Photo $photo */
        $photo = Photo::find($photo_id);

        //first delete from s3, then remove from db
        //
        $delete_true = Storage::disk('s3')->delete($photo->url);
        $photo->delete();

        return redirect(route('photos_index'))
            ->with('message', 'Photo '.$photo->name.' Deleted');
    }
}
