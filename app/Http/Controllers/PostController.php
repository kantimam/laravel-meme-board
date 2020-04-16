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
        $posts=Post::orderByDesc('created_at')->get();
        return view(
            'home', 
            [
            'posts'=>$posts
            ]
        );
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPopular()
    {
        //
        $posts=Post::orderBy('rating', 'DESC')->get();
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
                    $userId=Auth::id();
                    if($userId){
                        $post->user_id=$userId;
                    }
                    $post->save();
                    return view('uploadSucces');
                } /* handle thumbnail fail */
                
            } /* handle image  fail */
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
            $post->increment("views");
            $post->save();

            if(Auth::check()){
                /* if user is logged in figure out if he voted and what his vote is  */
                $userVote=0;
                $userId=Auth::id();
                $vote=$post->votes()->where('user_id', $userId)->first();

                if($vote){
                    $userVote=$vote->vote;
                }
                $post['vote']=$userVote;

            }
            

            return view('post',['post'=>$post]);
        }catch(Exeption $e){
            return redirect('/');
        }
    }


    /**
     * Display the specified resource with preview.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithPreview($id)
    {
        try{
            $post=Post::findOrFail($id);
            $post->increment("views");
            $post->save();

            if(Auth::check()){
                /* if user is logged in figure out if he voted and what his vote is  */
                $userVote=0;
                $userId=Auth::id();
                $vote=$post->votes()->where('user_id', $userId)->first();

                if($vote){
                    $userVote=$vote->vote;
                }
                $post['vote']=$userVote;

            }

            $olderPosts=Post::where('created_at', '<', $post->created_at)->orderByDesc('created_at')->take(10)->select('id', 'thumbnail')->get();

            $newerPosts=Post::where('created_at', '>', $post->created_at)->take(2)->select('id', 'thumbnail')->get();


            //return ['post'=>$post, 'nextPosts'=>$nextPosts, 'prevPosts'=>$prevPosts];
            return view('post',['post'=>$post, 'nextPosts'=>$olderPosts, 'prevPosts'=>$newerPosts->reverse(), 'feed'=>'new']);

        }catch(Exeption $e){
            return redirect('/');
        }
    }

    /**
     * Display the specified resource with preview.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithPopularPreview($id)
    {
        try{
            $post=Post::findOrFail($id);
            $post->increment("views");
            $post->save();

            if(Auth::check()){
                /* if user is logged in figure out if he voted and what his vote is  */
                $userVote=0;
                $userId=Auth::id();
                $vote=$post->votes()->where('user_id', $userId)->first();

                if($vote){
                    $userVote=$vote->vote;
                }
                $post['vote']=$userVote;

            }

            $lowerRatedPosts=Post::where('rating', '<=', $post->rating)->where('id', '!=', $post->id)->orderByDesc('rating')->take(10)->select('id', 'thumbnail')->get();

            $higherRatedPosts=Post::where('rating', '>', $post->rating)->orderBy('rating')->take(2)->select('id', 'thumbnail')->get();

            

            //return ['post'=>$post, 'nextPosts'=>$nextPosts, 'prevPosts'=>$prevPosts];
            return view('post',['post'=>$post, 'nextPosts'=>$lowerRatedPosts, 'prevPosts'=>$higherRatedPosts, 'feed'=>'popular']);

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
        $userId=Auth::id();
        if(!$userId) return response("you need to be logged in to vote", 403);

        if(!$request->has('postId')) return response("can not find post without id", 404);

        if(!$request->has('vote') || !($request->vote==1 || $request->vote==-1)){
            return response("invalid vote!", 403);
        }

        try{
            $post=Post::findOrFail($request->postId);
            
            $myVote=$request->vote;

            $vote=$post->votes()->where('user_id',$userId)->first();

            
            if($vote){
                if($vote->vote==$myVote){
                    $vote->delete();
                    $post->updateRating();
                    return ["rating"=> $post->rating, "vote"=> 0];
                }
                else{
                    $vote->vote=$myVote;
                    $vote->save();
                    $post->updateRating();
                    return ["rating"=> $post->rating, "vote"=> $myVote];
                }
                
            }else{
                $newVote=new Vote();
                $newVote->vote=$myVote;
                $newVote->user_id=$userId;
                $newVote->post_id=$request->postId;

                $newVote->save();
                $post->updateRating();
                return ["rating"=> $post->rating, "vote"=> $myVote];
            }
        }
        catch(ModelNotFoundException $e){
            return response("can not find post without id", 404);
        }
    }

    public function comment(Request $request){
        return $request;
    }
    
}
