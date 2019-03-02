<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = array('title', 'description');

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
