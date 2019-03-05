<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoto;
use App\Photo;
use App\Policies\PhotoPolicy;
use App\UserPhoto;
use App\Vacation;
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
                'photos' => $photos,
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
    public function create(int $vacation_id = null)
    {
        //get vacation passed in or get all vacations
        //
        if(!empty($vacation_id)) {
            $vacations = Vacation::find($vacation_id);
        }
        else {
            $vacations = Vacation::all();
        }
        $viewdata['models']['vacations'] = $vacations;
        return view('photos.create', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param StorePhoto $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(StorePhoto $request)
    {
        $validated = $request->validated();

        //get file
        $image = $request->file('photo.file');

        //create new photo with photo input
        $photo = new Photo($request->input('photo'));

        //get logged in user
        $user = Auth::user();

        $photo->user_id = $user->id;

        //wrap this in transaciton so we dont end up with lost photos on s3
        try{
            $storagePath = Storage::disk('s3')->put("photos", $image, 'public');
            $photo->setAttribute('url', $storagePath);
            $photo->save();
        }
        catch(\Exception $e) {
            Storage::disk('s3')->delete($photo->storagePath);
            dd($e);
            throw $e;
        }

        return redirect(route('vacation_view', ['vacation_id' => $photo->vacation_id]));
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
