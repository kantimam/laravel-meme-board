
@extends('layouts.app')


@section('content')
        <div class="inner fullHeight">
            <div id="postLayout">
                {{-- interface to interact with post --}}
                <section id="postOptionsFixed">
                    <div id="postOptionsWrapper">
                        <div class="ratePostWrapper fancyShadow">
                            <div class="ratingWrapper">
                                <p onclick="vote(1)" id="upvoteButton" class="upvote centerAll {{ $post->vote == 1? 'upvoteActive' : '' }}" >+</p>
                                <p id="postRatingValue" class="rating">{{$post->rating}}</p>
                                <p onclick="vote(0)"  id="downvoteButton" class="downvote centerAll {{ $post->vote == -1? 'downvoteActive' : '' }}" >-</p>
                            </div>
                            <div class="like">
                                
                            </div>
                        </div>
                    </div>
                </section>

                {{-- actual image / post --}}
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
                <section id="postFeed" class="fancyShadow">
                    <div class="previewHeader centerAll">
                        POST FEED
                    </div>
                    <div class="postPreviewList">
                        @forelse ($prevPosts as $item)
                        <a href={{"/post/".$item->id}}>
                            <img src={{"/".$item->thumbnail}} alt="thumbnail">
                        </a>
                        @empty
                            <div class="postPreviewEmpty centerAll">NULL</div>
                        @endforelse
                            <a class="active"  href={{"/post/".$post->id}}>
                                <img src={{"/".$post->thumbnail}} alt="thumbnail">
                            </a>    
                        @forelse ($nextPosts as $item)
                            <a href={{"/post/".$item->id}}>
                                <img src={{"/".$item->thumbnail}} alt="thumbnail">
                            </a>
                        @empty
                            <div class="postPreviewEmpty centerAll">NULL</div>
                        @endforelse
                    </div>
                </section>
            </div>
            
        </div>
        @auth
            <script>
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                function vote(vote){
                    const postId={{$post->id}}                
                    if(postId && token){
                        const formData=new FormData();
                        formData.append('vote', vote? 1 : -1);
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
                                if(!response.ok) throw Error(response.statusText)
                                return response.json();
                            })
                            
                            .then(data=>{
                                if(isNaN(data.vote) || isNaN(data.rating)) throw Error('unexpected response');
                                document.querySelector('#postRatingValue').innerHTML=data.rating;
                                
                                const upvote=document.querySelector('#upvoteButton');
                                const downvote=document.querySelector('#downvoteButton');
                                upvote.classList.remove('upvoteActive');
                                downvote.classList.remove('downvoteActive');

                                if(data.vote==-1){
                                    downvote.classList.add('downvoteActive');
                                }else if(data.vote==1){
                                    upvote.classList.add('upvoteActive');
                                }
                            }
                            )
                            .catch(e=>{
                                console.log(e);
                                /* window.location.href = '/'; */
                            }
                            )
                    }
                    else alert("request failed :(")

                }
            </script>
        @endauth
        @guest
            <script>
                function vote(vote){
                    openAlert();
                }
            </script>
        @endguest
        
@endsection
