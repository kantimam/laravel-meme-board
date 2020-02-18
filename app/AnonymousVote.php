<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AnonymousVote extends Model
{
    public $timestamps = false;
    
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
