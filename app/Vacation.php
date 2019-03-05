<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    //
    protected $fillable = array('title', 'description');

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
