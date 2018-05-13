<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_text', 'is_hidden', 'topic_id', 'author_name', 'author_email'];
    
    public function topic()
    {
        return $this->belongsTo('Topic');
    }
    
    public function answered()
    {
        return $this->hasOne('App\Answer')->exists();
    }
    
    public function answer()
    {
        return $this->hasOne('App\Answer');
    }

    //
}
