<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function domain()
    {
    	return $this->hasMany('App\Domain');
    }
}
