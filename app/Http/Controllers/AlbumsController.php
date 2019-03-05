<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\StoreAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    public function index()
    {
        //
        $albums = Album::all();
        $user = Auth::user();

        $viewdata = [
            'models' => [
                'user' => $user,
                'albums' => $albums,
            ],
        ];
        return view('albums.index', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('albums.create');
    }

    /**
     * @author mattbeal
     * @param StoreAlbum $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAlbum $request)
    {
        $validated = $request->validated();

        //get file
        $image = $request->file('album.file');

        //create new album with album input
        $album = new Album($request->input('album'));

        //get logged in user
        $user = Auth::user();

        $album->user_id = $user->id;

        $storagePath = Storage::disk('s3')->put("albums", $image, 'public');
        $album->setAttribute('url', $storagePath);
        $album->save();


        return redirect(route('albums_index'));
    }

    /**
     * @author mattbeal
     * @param int $album_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function view(int $album_id)
    {
        //find album by id and return
        $album = Album::find($album_id);
        $user = Auth::user();
        $album_policy = new AlbumPolicy();

        $viewdata = [
            'models' => [
                'user' => $user,
                'album' => $album,
            ],
            'policies' => [
                'album' => $album_policy,
            ],
        ];
        return view('albums.view', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param int $album_id
     * @throws \Exception
     * @return RedirectResponse
     */
    public function delete(int $album_id)
    {
        /** @var Album $album */
        $album = Album::find($album_id);
        $user = Auth::user();

        $album_policy = new AlbumPolicy();
        if(!$album_policy->delete($user,$album)) {
            return redirect(route('albums_index'))
                ->with('message', 'You do not have permission to delete.');
        }

        //first delete from s3, then remove from db
        //
        $delete_true = Storage::disk('s3')->delete($album->url);
        $album->delete();

        return redirect(route('albums_index'))
            ->with('message', 'Album '.$album->name.' Deleted');
    }
}
