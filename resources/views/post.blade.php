
@extends('layouts.app')


@section('content')
        <div class="inner">
            <div id="postLayout">
                <section id="postOptions">
                    <div class="ratePostWrapper">
                        <div class="ratingWrapper">
                            <p class="upvote">+</p>
                            <p class="rating">{{$post->rating}}</p>
                            <p class="downvote">-</p>
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
@endsection
