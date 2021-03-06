@extends('layouts.app')


@section('content')
    <div class="centerAll flexContent fullMinHeight">
        <form id="uploadForm" action="/post" method="POST" enctype="multipart/form-data" class="flexCenterAllVert fancyShadow">
            <input accept="image/" type="file" name="image" id="file">
            
            <div id="dropZoneWrapper"  class="centerAll mainColor fullSizeBg" style="background-image: url({{asset("image/upload_illustration.svg")}})">
                <div id="uploadInfo">
                    {{-- <img class="margin0Auto" src="{{asset('icon/square-upload.svg')}}" alt="upload"/> --}}
                    <strong class="pointer">Choose a file&nbsp</strong>
                    <span>or drag and dropt it here!</span>
                    <h3>DROP YOUR FILE! :)</h3>
                </div>
                

                <label for="file" id="dropZone">
                    
                </label>
            </div>

            
            <div id="uploadPreview">
                <div id="uploadPreviewClose" class="closeIcon centerAll pointer">X</div>
                <img id="uploadPreviewImage" src="" alt="image preview">
            </div>

            <div class="textInputWrapper">
                <label for="postTitle">{{ __('Post Title') }}</label>
                <input class="textInput" id="postTitle" type="text" name="title" autofocus>
            </div>

            <div class="textInputWrapper tagsInputWrapper">
                <label for="postTags">{{ __('Post Tags') }}</label>
                <input id="postTags" placeholder="add a few tags seperated by ," class="textInput tagsInput" type="text" name="tags">
            </div>

            <input class="mainSubmit mainColor" type="submit">
            
            @csrf
        </form>
    </div>

    <script src="{{ asset('js/form.js') }}">
    </script>

    <script src="{{ asset('js/dragDrop.js') }}">
    </script>  
@endsection
