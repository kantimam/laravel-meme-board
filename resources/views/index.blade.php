
@extends('layouts.mainLayout')


@section('content')
    <div class="">
        <div class="inner test">
            <div class="title m-b-md">
                MIRROR
            </div>

            <h3>{{$data}}</h3>

            <div class="thumbnailGrid">
                @forelse ($posts as $post)
                    <a href={{$post->file}}>
                        <img src={{$post->thumbnail}} alt="thumbnail">
                    </a>
                @empty
                    <h3 class="centerText">NOTHING FOUND</h3>    
                @endforelse
            </div>
        </div>
    </div>  
@endsection
