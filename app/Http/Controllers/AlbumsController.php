<?php

namespace App\Http\Controllers;

use App\Album;
use App\Category;
use App\Http\Requests\StoreAlbum;
use Illuminate\Support\Facades\Auth;

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
                'albums' => $albums->sortByDesc('created_at'),
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

        $viewdata = [
            'models' => [
                'user' => $user,
                'album' => $album,
            ],
        ];

        return view('albums.view', ['viewdata' => $viewdata]);
    }
}
