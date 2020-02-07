@extends('layouts.mainLayout')


@section('content')
    <div class="">
        <div class="inner test">
            <form id="uploadForm" action="/post" method="POST" enctype="multipart/form-data" class="flexCenterAllVert">
                <input accept="image/" type="file" name="image" id="file">
                <label for="file" class="centerAll" id="dropZone">
                    <strong class="pointer">Choose a file &nbsp</strong>
                    <span>or drag and dropt it here</span>
                    <h3>DROP YOUR FILE! :)</h3>
                </label>
                
                <div id="uploadPreview">
                    <img id="uploadPreviewImage" src="" alt="image preview">
                </div>

                <input type="text" name="title">
                <input type="submit">
                @csrf
            </form>
        </div>
    </div>
    <script>
        const input=document.querySelector("#file");
        const dropZone=document.querySelector("#dropZone");
        const uploadForm=document.querySelector('#uploadForm')

        dropZone.addEventListener("dragover", handleDragEnter, false)
        dropZone.addEventListener("dragenter", handleDragEnter, false)

        dropZone.addEventListener("dragleave", handleDragLeave, false)
        dropZone.addEventListener("dragend", handleDragLeave, false)
        dropZone.addEventListener("drop", handleDrop, false)


        function handleDragEnter(event){
            event.preventDefault();
            event.stopPropagation();
            //if(event.currentTarget!==event.target) return
            dropZone.classList.add("dragOver")
        }
        function handleDragLeave(event){
            event.preventDefault();
            event.stopPropagation();
            if(event.currentTarget!==event.target) return
            dropZone.classList.remove("dragOver")
        }

        function handleDrop(event){
            event.preventDefault();
            event.stopPropagation();
            if(event.currentTarget!==event.target) return
            dropZone.classList.remove("dragOver")
            const dataTransfer=event.dataTransfer;
            const files=dataTransfer.files;
            if(files.length>1) return alert("only single file upload allowed!")
            
            input.files=files

            uploadForm.classList.add("showUploadPreview");
        }

    </script>  
@endsection
