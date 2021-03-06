<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\StorePhoto;
use App\Photo;
use App\Policies\PhotoPolicy;
use App\UserPhoto;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\RedirectResponse;
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
            $albums = Album::all()->reverse();
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
        try {
            $validated = $request->validated();
            //create new photo with photo input
            if (!empty($request->input('photo'))) {
                $img = Image::make(Input::file('photo')['file']->getRealPath())->orientate()->encode('jpg');
            } else {
                throw new \Exception('No Photo Chosen');
            }
            $photo = new Photo($request->input('photo'));
            //get logged in user
            $user = Auth::user();
            //$photo = new Photo($request->);
            $photo->user_id = $user->id;

            //generate random file path
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 32; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $filePath = "photos/" . $randomString . '.jpg';

            Storage::disk('s3')->put($filePath, $img, 'public');

            $photo->setAttribute('url', $filePath);
            $photo->save();

            //assocaite album if user chose one
            //
            if (!empty($request->input('album.id'))) {
                $photo->albums()->attach($request->input('album.id'));
            } else {
                $photo->albums()->attach(2);
            }
            return redirect(route('photos_index'));
        } catch(\Exception $e) {
            echo $e->getMessage();
            dd($e->getTrace());
        }
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
