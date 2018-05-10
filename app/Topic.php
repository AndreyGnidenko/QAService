<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;

class Topic extends Model
{
    protected $fillable = ['name'];
    
    public function questions ()
    {
        return $this->hasMany('App\Question');
    }
    
    public function answers ()
    {
        return $this->hasManyThrough('App\Answer', 'App\Question');
    }
    
    public function totalCount()
    {
        return $this->questions()->count();
    }
    
    public function answeredCount ()
    {
        return $this->answers()->count();
    }
    
    public function unAnsweredCount ()
    {
        return $this->answers()->count();
    }
}
