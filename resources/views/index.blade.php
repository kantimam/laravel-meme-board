
@extends('layouts.app')


@section('content')
        <div class="inner">
            <div id="infoContainer">
            </div>
            <div class="thumbnailGrid">
                @forelse ($posts as $post)
                    <a href={{"/post/".$post->id}}>
                        <img src={{$post->thumbnail}} alt="thumbnail">
                    </a>
                @empty
                    <h3 class="centerText">NOTHING FOUND</h3>    
                @endforelse
            </div>
        </div>
@endsection
