<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text', 'is_hidden'];
    
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
        return $this->hasOne('App\Answer')->withDefault([
            'answer_text' => null
        ]);
    }

    //
}
