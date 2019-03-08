<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Role;
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
        $admin = Auth::user();

        $viewdata = [
            'models' => [
                'user' => $admin,
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
        $roles = Role::all();
        $viewdata['models']['categories'] = $roles;
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

        //set default password
        $user->setAttribute('password', bcrypt('Bealfun22'));

        $user->save();

        if(!empty($request->input('user.roles'))) {
            foreach($request->input('user.roles') as $role_id) {
                $user->attach($role_id);
            }
        }

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
        $admin = Auth::user();

        $roles = Role::all();

        $roles_index = [];
        foreach($roles as $role) {
            if(!empty($user()->roles()->where('title',$role->title)->first())) {
                $roles_index[$role] = true;
            }
            else {
                $roles_index[$role] = false;
            }
        }

        $viewdata = [
            'models' => [
                'admin' => $admin,
                'user' => $user,
            ],
        ];

        return view('users.view', ['viewdata' => $viewdata]);
    }

    /**
     * @author mattbeal
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request, int $user_id)
    {
    }
}
