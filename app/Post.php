<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function votes(){
        return $this->hasMany('App\Vote');
    }
    public function anonymousVotes(){
        return $this->hasMany('App\AnonymousVote');
    }
    public function user(){
        return $this->belongsTo('App\User')->select(array("id","name"));
    }
}
