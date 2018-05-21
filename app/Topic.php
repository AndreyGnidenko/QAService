<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;

class Topic extends Model
{
    protected $fillable = ['name'];
    
    public function questions ()
    {
        return $this->hasMany(Question::class);
    }
    
    public function answers ()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }
    
    public function totalCount()
    {
        return $this->questions()->count();
    }

    public function hiddenCount ()
    {
        return $this->answers()->where('is_hidden', true)->count();
    }
    
    public function answeredCount ()
    {
        return $this->questions()->where('is_hidden', false)->has('answer')->count();
    }
    
    public function unAnsweredCount ()
    {
        return $this->questions()->where('is_hidden', false)->doesntHave('answer')->count();
    }
}
