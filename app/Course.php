<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	public function domain()
    {
    	return $this->belongsTo('App\Domain');
    }

    public function class() 
    {
    	return $this->hasMany('App\Classes');
    }
}
