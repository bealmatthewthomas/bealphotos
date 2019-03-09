<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = array('title', 'description');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album','album_photo');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
