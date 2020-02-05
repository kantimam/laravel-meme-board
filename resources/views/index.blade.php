
@extends('layouts.mainLayout')


@section('content')
    <div class="">
        <div class="inner test">
            <div class="title m-b-md">
                MIRROR
            </div>

            <h3>{{$data}}</h3>

            <div class="thumbnailGrid">
                @foreach ($posts as $post)
                <a href="https://i.imgur.com/DqTyMHI.jpeg">
                    <img src="https://i.imgur.com/vQc8wQx.jpg" alt="thumbnail">
                </a>    
                @endforeach
            </div>
        </div>
    </div>  
@endsection
