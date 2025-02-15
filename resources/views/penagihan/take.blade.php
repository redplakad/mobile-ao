@extends('layouts.no-nav')

@section('content')
<div id="Top-nav" class="flex items-center justify-between px-4 pt-5">
        <a href="{{ route('penagihan.create') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Buat Penagihan</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Buat laporan penagihan baru</p>
        </div>
        <a href="{{ route('front.index') }}" class="w-10 h-10 flex shrink-0">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-x />
            </div>
        </a>
    </div>
<div class="max-w-screen-sm mx-auto bg-white min-h-screen p-3">
    <div class="flex flex-col justify-center items-center relative">
        <video autoplay playsinline id="video-webcam" class="w-full max-w-md">
            Browsermu tidak mendukung bro, upgrade donk!
        </video>

        <div class="flex justify-center mt-3 absolute bottom-0">
            <button class="bg-[#FDC500] text-white px-4 py-2 rounded-lg mb-3" onclick="takeSnapshot()">
                <x-tabler-camera />
            </button>
        </div>
    </div>
</div>
@endsection

@push('javascript')

<script>
    localStorage.removeItem('image');
    let video = document.getElementById("video-webcam");
    let useFrontCamera = false;
    let stream = null;

    async function startCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }

        let constraints = {
            video: {
                facingMode: useFrontCamera ? "user" : "environment"
            }
        };

        try {
            stream = await navigator.mediaDevices.getUserMedia(constraints);
            video.srcObject = stream;
        } catch (err) {
            alert("Gagal mengakses kamera: " + err.message);
        }
    }

    function takeSnapshot() {
        let canvas = document.createElement('canvas');
        let context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        let dataURL = canvas.toDataURL('image/png');
        localStorage.setItem('image', dataURL);
        window.location.href = '{{ route("penagihan.take.preview") }}';
    }

    document.addEventListener("DOMContentLoaded", startCamera);
</script>

@vite(['resources/js/take.js'])
@endpush
