<?php

namespace App\Http\Controllers;

use App\Album;
use App\Category;
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
        dd($viewdata['models']['albums'][0]->photos());

        return view('albums.index', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $viewdata['models']['categories'] = $categories;
        return view('albums.create', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param StoreAlbum $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAlbum $request)
    {
        $validated = $request->validated();

        //create new album with album input, and attach chosen category
        $album = new Album($request->input('album'));

        $album->save();

        if(!empty($request->input('category.id'))) {
            $album->categories()->attach($request->input('category.id'));
        }

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
}
