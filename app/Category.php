<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = array('title');

    public function albums()
    {
        return $this->belongsToMany('App\Album', 'album_category');
    }
}
