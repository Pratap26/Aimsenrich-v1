<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDocument extends Model
{
    protected $fillable = ['lesson_id', 'title', 'path'];

    public function lesson()
    {
    	return $this->belongsTo('App\Lesson');
    }
}
