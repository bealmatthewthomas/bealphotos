<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;

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
        $photos = Photo::first(10);
        $albums = Album::first(4);

        $viewdata = [
            'models' => [
              'users' => $photos,
              'albums' => $albums,
            ],
        ];
        return view('welcome', ['viewdata' => $viewdata]);
    }
}
