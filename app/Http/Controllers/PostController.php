<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\AnonymousVote;
use App\Vote;

class PostController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::orderBy('created_at', 'DESC')->get();
        return view(
            'home', 
            [
            'posts'=>$posts
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->has('image')){
            $post=new Post;
            $name=request()->image->store('uploads', 'public');
            if($name){ 
                $thumbnailPath='storage/thumbnails/thumbnail_'.request()->image->hashName();
                $thumbnail=Image::make(request()->image)->fit(320,240)->encode('jpg')->save($thumbnailPath);
                if($thumbnail){
                    $post->file='storage/'.$name;
                    $post->thumbnail=$thumbnailPath;
                    if(request()->has('title')){
                        $post->title=request()->title;
                    }
                    $post->save();
                    return view('uploadSucces');
                }
                
            }
        }
        return "image is required";

    }


/*     private function validateStore(){
        $validateData=request()->validate([

        ])
    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $post=Post::findOrFail($id);
            return view('post',['post'=>$post]);
        }catch(Exeption $e){
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function vote(Request $request){
        if($request->has('vote') && $request->has('postId') && $request->postId!=null){
            if(Auth::check()){
                /* if user is logged in vote with his useID */
                //$vote->save();
                return "you are logged in :)";
            }
            /* if not logged in vote with his sessionToken */
            return response("you need to be logged in to vote", 403);;
        }
        return 'vote failed! :(';        
    }

    public function voteWithAnon(Request $request){
        if($request->has('vote') && $request->has('postId') && $request->postId!=null){
            if(Auth::check()){
                /* if user is logged in vote with his useID */
                //$vote->save();
                return "you are logged in :)";
            }
            /* if not logged in vote with his sessionToken */
            return $this->anonVote($request->postId, $request->vote, $request->session()->get('_token'));
        }
        return 'vote failed! :(';        
    }

    private function anonVote($postId, $inVote, $sessionToken){
        $vote=new AnonymousVote;
        if($vote::where('session_id', $sessionToken)->where('post_id', $postId)->first()){
            return response("there is already a vote with this session token", 409);
        }

        $myVote=$inVote=='upvote'? 1 : -1;
        $vote->vote=$myVote;
        $vote->post_id=$postId;
        $vote->session_id=$sessionToken;
        $vote->save();
        return "succesfully voted! :)";
    }
}
