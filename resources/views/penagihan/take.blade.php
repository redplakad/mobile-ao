@extends('layouts.no-nav')
<div class="max-w-screen-sm mx-auto bg-white min-h-screen p-3">
    <div class="flex flex-col justify-center items-center relative">
        <video autoplay muted id="video-webcam" class="w-full max-w-md">
            Browsermu tidak mendukung bro, upgrade donk!
        </video>

        <div class="flex justify-center mt-3 absolute bottom-0">
            <button class="bg-[#FDC500] text-white px-4 py-2 rounded-lg mb-3" onclick="takeSnapshot()">
                <x-tabler-camera />
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    var video = document.querySelector("#video-webcam");

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
    navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({
        video: true
    }, handleVideo, videoError);
}

function handleVideo(stream) {
    video.srcObject = stream;
}

function videoError(e) {
    alert("Izinkan menggunakan webcam untuk demo!");
}

function takeSnapshot() {
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video-webcam');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0);
    var dataURL = canvas.toDataURL('image/png');
    localStorage.setItem('image', dataURL);

    window.location.href = '/preview.html';
}

</script>
@vite(['resources/js/take.js'])
