
@extends('layouts.app')


@section('content')
        <div class="inner">
            <div id="postLayout">
                <section id="postOptions">
                    <div class="ratePostWrapper fancyShadow">
                        <div class="ratingWrapper">
                            <p onclick="vote(1)" class="upvote">+</p>
                            <p class="rating">{{$post->rating}}</p>
                            <p onclick="vote(0)" class="downvote">-</p>
                        </div>
                        <div class="like">
                            
                        </div>
                    </div>
                </section>
                <section id="postWrapper">
                    <h1>{{$post->title}}</h1>
                    <div id="postNav">
                        <div class="postMetaData">
                            
                        </div>
                        <div class="prevNext">

                        </div>
                    </div>
                    <img src={{"/".$post->file}} alt="thumbnail">
                </section>
                <section id="postComments"></section>
            </div>
            
        </div>
        <script>
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            function vote(vote){
                const postId={{$post->id}};
                if(postId && token){
                    const formData=new FormData();
                    formData.append('vote', vote? 'upvote' : 'downvote');
                    formData.append('postId', postId);
                    fetch(`/vote/post`, {
                        headers: {
                            "Accept": "application/json, text-plain, */*",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'post',
                        credentials: "same-origin",
                        body: formData
                        })
                        .then(response=>{
                            return response.text();
                        })
                        .then(data=>
                            console.log(data)
                        )
                        .catch(e=>
                            console.log(e)
                        )
                }
                else alert("request failed :(")

            }
        </script>
@endsection
