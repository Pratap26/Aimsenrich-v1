<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function document() 
    {
    	return $this->hasMany('App\LessonDocument');
    }
}
