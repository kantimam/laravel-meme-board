const input = document.querySelector("#file");
const dropZone = document.querySelector("#dropZone");
const dropZoneWrapper = document.querySelector("#dropZoneWrapper");
const uploadForm = document.querySelector('#uploadForm')

document.querySelector('#uploadPreviewClose').addEventListener('click', resetUpload)

dropZone.addEventListener("dragover", handleDragEnter, false)
dropZone.addEventListener("dragenter", handleDragEnter, false)

dropZone.addEventListener("dragleave", handleDragLeave, false)
dropZone.addEventListener("dragend", handleDragLeave, false)
dropZone.addEventListener("drop", handleDrop, false)


function handleDragEnter(event) {
    event.preventDefault();
    event.stopPropagation();
    dropZoneWrapper.classList.add("dragOver")
}

function handleDragLeave(event) {
    event.preventDefault();
    event.stopPropagation();
    if (event.currentTarget !== event.target) return
    dropZoneWrapper.classList.remove("dragOver")
}

function handleDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    if (event.currentTarget !== event.target) return
    dropZoneWrapper.classList.remove("dragOver")
    const dataTransfer = event.dataTransfer;
    const files = dataTransfer.files;
    if (files.length > 1) return alert("only single file upload allowed!")

    input.files = files

    showPreview(input)

}

input.addEventListener('change', () => showPreview(input));

function showPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const uploadPreviewImage = document.querySelector("#uploadPreviewImage");
            uploadPreviewImage.src = event.target.result;

            /* once filedata is loaded inside the browser hidde the dropZone and show the image instead */
            uploadForm.classList.add("showUploadPreview");
        }
        reader.readAsDataURL(input.files[0])

    }
}

function resetUpload() {
    uploadForm.classList.remove("showUploadPreview");
    uploadForm.reset();
}
