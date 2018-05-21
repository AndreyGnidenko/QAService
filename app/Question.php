<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Topic;

class Question extends Model
{
    protected $fillable = ['question_text', 'is_hidden', 'topic_id', 'author_name', 'author_email'];
    
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    
    public function answered()
    {
        return $this->answer()->exists();
    }
    
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    //
}
