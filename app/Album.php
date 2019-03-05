<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = array('title', 'description','category');

    public function photos()
    {
        $this->belongsToMany('App\Photo', 'album_photo');
    }

}
