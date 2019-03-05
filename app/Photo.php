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

    public function vacation()
    {
        return $this->belongsTo('App\Vacation');
    }
}
