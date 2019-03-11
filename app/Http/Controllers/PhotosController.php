<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\StorePhoto;
use App\Photo;
use App\Policies\PhotoPolicy;
use App\UserPhoto;
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
        $photo_policy = new PhotoPolicy();

        $viewdata = [
            'models' => [
                'user' => $user,
                'photos' => $photos->sortByDesc('created_at'),
            ],
            'policies' => [
                'photo' => $photo_policy,
            ],
        ];
        return view('photos.index', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(int $album_id = null)
    {
        if(!empty($album_id)) {
            $albums = Album::find($album_id);
            $default = true;
        } else {
            $albums = Album::all();
            $default = false;
        }

        $viewdata = [
            'models' => [
                'albums' => $albums,
            ],
            'data' => [
                'album_default' => $default,
            ],
        ];
        $viewdata['models']['albums'] = $albums;


        return view('photos.create', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param StorePhoto $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePhoto $request)
    {
        $validated = $request->validated();

        //get file
        $image = $request->file('photo.file');

        //create new photo with photo input
        if(!empty($request->input('photo'))) {
            $photo = new Photo($request->input('photo'));
        }
        else {
            $photo = new Photo();
        }

        //get logged in user
        $user = Auth::user();

        $photo->user_id = $user->id;

        $storagePath = Storage::disk('s3')->put("photos", $image, 'public');
        $photo->setAttribute('url', $storagePath);
        $photo->save();

        //assocaite album if user chose one
        //
        if(!empty($request->input('album.id'))) {
            $photo->albums()->attach($request->input('album.id'));
        }
        else {
            $photo->albums()->attach($request->input());
        }

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
        $user = Auth::user();
        $photo_policy = new PhotoPolicy();

        $viewdata = [
            'models' => [
                'user' => $user,
                'photo' => $photo,
            ],
            'policies' => [
                'photo' => $photo_policy,
            ],
        ];
        return view('photos.view', ['viewdata' => $viewdata]);
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
        $user = Auth::user();

        $photo_policy = new PhotoPolicy();
        if(!$photo_policy->delete($user,$photo)) {
            return redirect(route('photos_index'))
                ->with('message', 'You do not have permission to delete.');
        }

        //first delete from s3, then remove from db
        //
        $delete_true = Storage::disk('s3')->delete($photo->url);
        $photo->delete();

        return redirect(route('photos_index'))
            ->with('message', 'Photo '.$photo->name.' Deleted');
    }
}
