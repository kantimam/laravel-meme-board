@extends('layouts.app')


@section('content')
    <div class="centerAll flexContent fullHeight">
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
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input class="textInput" id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <input placeholder="add a few tags seperated by ," class="textInput" type="text" name="tags">

            <input class="mainSubmit fancyShadow mainColor" type="submit">
            
            @csrf
        </form>
    </div>

    <script src="{{ asset('js/form.js') }}">
    </script>

    <script>
        const input=document.querySelector("#file");
        const dropZone=document.querySelector("#dropZone");
        const dropZoneWrapper=document.querySelector("#dropZoneWrapper");
        const uploadForm=document.querySelector('#uploadForm')

        document.querySelector('#uploadPreviewClose').addEventListener('click', resetUpload)

        dropZone.addEventListener("dragover", handleDragEnter, false)
        dropZone.addEventListener("dragenter", handleDragEnter, false)

        dropZone.addEventListener("dragleave", handleDragLeave, false)
        dropZone.addEventListener("dragend", handleDragLeave, false)
        dropZone.addEventListener("drop", handleDrop, false)


        function handleDragEnter(event){
            event.preventDefault();
            event.stopPropagation();
            dropZoneWrapper.classList.add("dragOver")
        }
        function handleDragLeave(event){
            event.preventDefault();
            event.stopPropagation();
            if(event.currentTarget!==event.target) return
            dropZoneWrapper.classList.remove("dragOver")
        }

        function handleDrop(event){
            event.preventDefault();
            event.stopPropagation();
            if(event.currentTarget!==event.target) return
            dropZoneWrapper.classList.remove("dragOver")
            const dataTransfer=event.dataTransfer;
            const files=dataTransfer.files;
            if(files.length>1) return alert("only single file upload allowed!")
            
            input.files=files

            showPreview(input)

        }
        
        input.addEventListener('change',()=>showPreview(input));

        function showPreview(input){
            if(input.files && input.files[0]){
                const reader=new FileReader();

                reader.onload=function(event){
                    const uploadPreviewImage=document.querySelector("#uploadPreviewImage");
                    uploadPreviewImage.src=event.target.result;

                    /* once filedata is loaded inside the browser hidde the dropZone and show the image instead */
                    uploadForm.classList.add("showUploadPreview");
                }
                reader.readAsDataURL(input.files[0])

            }
        }
        function resetUpload(){
            uploadForm.classList.remove("showUploadPreview");
            uploadForm.reset();
        }

    </script>  
@endsection
