<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;

/**
 * Class HomepageController
 * @package App\Http\Controllers
 * @author mattbeal
 */
class HomepageController extends Controller
{
    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $photos = Photo::all();
        $albums = Album::all();

        $viewdata = [
            'models' => [
              'photos' => $photos,
              'albums' => $albums,
            ],
        ];
        return view('welcome', ['viewdata' => $viewdata]);
    }
}
