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

    public function updateRating(){
        $upvotes=Vote::where('post_id',$this->id)->where('vote','1')->count();
        $downvotes=Vote::where('post_id',$this->id)->where('vote','-1')->count();
        
        $this->rating=$upvotes-$downvotes;
        $this->save();
    }
}
