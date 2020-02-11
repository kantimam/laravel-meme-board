
@extends('layouts.mainLayout')


@section('content')
    <main>
        <div class="inner">
            <div id="postLayout">
                <section id="postOptions"></section>
                <section id="postWrapper">
                    <h1>FANCY POST</h1>
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
    </main>  
@endsection
