<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function index()
    {
        //
        $users = User::all();
        $user = Auth::user();

        $viewdata = [
            'models' => [
                'user' => $user,
                'users' => $users,
            ],
        ];

        return view('users.index', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewdata['models']['categories'] = $categories;
        return view('users.create', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param StoreUser $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUser $request)
    {
        $validated = $request->validated();

        //create new user with user input, and attach chosen category
        $user = new User($request->input('user'));

        if(!empty($request->input('user.roles'))) {
            foreach()
        }

        $user->save();

        return redirect(route('users_index'));
    }

    /**
     * @author mattbeal
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function view(int $user_id)
    {
        //find user by id and return
        $user = User::find($user_id);
        $user = Auth::user();

        $viewdata = [
            'models' => [
                'user' => $user,
                'user' => $user,
            ],
        ];

        return view('users.view', ['viewdata' => $viewdata]);
    }
}
