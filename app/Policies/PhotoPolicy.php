<?php

namespace App\Policies;

use App\Photo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return (!empty($user->roles()->where('title', 'photo')->first()));
    }

    public function delete(User $user, Photo $photo)
    {
        if (empty($user->roles()->where('title', 'photo')->first())) {
            return false;
        }elseif(!empty($user->roles()->where('title', 'admin')->first())){
            return true;
        }
        return $user->id == $photo->user()->first()->id;
    }
}
