@extends('layouts.no-nav')

@section('content')
<div class="max-w-screen-sm mx-auto min-h-screen bg-white p-4 flex flex-col items-center justify-center gap-4">

    <h2 class="text-lg font-bold text-center">Ambil Gambar</h2>

    <video id="video" autoplay playsinline class="w-full max-w-sm rounded-lg shadow border border-gray-200"></video>
    <canvas id="canvas" class="hidden"></canvas>

    <div class="flex justify-center mt-3 absolute bottom-0">
             
        <a href="{{ route('penagihan.take') }}" class="bg-gray-100 text-black px-4 py-2 rounded-lg mb-3 mr-3 shadow-md" id="switch-btn">
            <x-tabler-corner-up-left />
        </a>
        &nbsp;
        <button class="bg-[#FDC500] text-white px-4 py-2 rounded-lg mb-3 mr-3 shadow-md" id="capture-btn">
            <x-tabler-camera />
        </button>
        &nbsp;
        <button class="bg-gray-200 text-black px-4 py-2 rounded-lg mb-3 shadow-md" id="switch-btn">
            <x-tabler-switch-horizontal />
        </button>  
    </div>
</div>
@endsection

@push('javascript')
<script>
    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let captureBtn = document.getElementById('capture-btn');
    let switchBtn = document.getElementById('switch-btn');

    let currentStream = null;
    let useFrontCamera = true;

    const imageId = new URLSearchParams(window.location.search).get('image{{ $image }}') || 1;

    async function startCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
        }

        try {
            const constraints = {
                video: {
                    facingMode: useFrontCamera ? 'user' : 'environment'
                },
                audio: false
            };

            currentStream = await navigator.mediaDevices.getUserMedia(constraints);
            video.srcObject = currentStream;
        } catch (error) {
            alert("Gagal mengakses kamera: " + error.message);
        }
    }

    switchBtn.addEventListener('click', () => {
        useFrontCamera = !useFrontCamera;
        startCamera();
    });

    captureBtn.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL('image/jpeg');
        localStorage.setItem('image' + {{ $image }}, imageData);
        alert("Foto berhasil diambil!");

        // Redirect balik ke halaman preview
        window.location.href = "{{ route('penagihan.take') }}";
    });

    window.addEventListener('DOMContentLoaded', startCamera);
</script>
@endpush
