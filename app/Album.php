<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = array('title', 'description');

    public function photos()
    {
        return $this->belongsToMany('App\Photo', 'album_photo');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'album_category');
    }

}
