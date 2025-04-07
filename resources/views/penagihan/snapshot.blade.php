@extends('layouts.no-nav')

@section('content')
    <div class="max-w-screen-sm mx-auto min-h-screen bg-white p-4 flex flex-col items-center justify-center gap-4">
        @php
            switch ($image) {
                case 1:
                    $description = 'Foto Debitur';
                    break;
                case 2:
                    $description = 'Foto Lokasi Penagihan';
                    break;
                case 3:
                    $description = 'Foto Debitur & Petugas';
                    break;
                case 4:
                    $description = 'Foto Lainnya';
                    break;
                default:
                    $description = 'Foto';
                    break;
            }
        @endphp

        <h2 class="text-lg font-bold text-center">{{ $description }}</h2>

        <video id="video" autoplay playsinline class="w-full max-w-sm rounded-lg shadow border border-gray-200"></video>
        <canvas id="canvas" class="hidden"></canvas>

        <div class="flex justify-center mt-3 absolute bottom-0">

            <a href="{{ request()->has('edit') ? route('penagihan.take', ['edit' => request('edit')]) : route('penagihan.take') }}"
                class="bg-gray-100 text-black px-4 py-2 rounded-lg mb-3 mr-3 shadow-md"
                id="switch-btn">
                 <x-tabler-corner-up-left />
             </a>             
            &nbsp;
            <button class="bg-[#FDC500] text-white px-4 py-2 rounded-lg mb-3 mr-3 shadow-md" id="captureBtn">
                <x-tabler-camera />
            </button>
            &nbsp;
            <button class="bg-gray-200 text-black px-4 py-2 rounded-lg mb-3 shadow-md" id="switchBtn">
                <x-tabler-switch-horizontal />
            </button>
        </div>
    </div>

    <div id="successModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full shadow-lg">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
          </div><h3 class="text-lg font-semibold text-center mt-4 text-gray-900">Foto disimpan</h3>
          <p class="text-sm text-center text-gray-600 mt-2">Pastikan data penagihan disimpan agar foto tidak hilang.</p>
          
          <div class="mt-5">
            <button id="modalCloseBtn" type="button"
              class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
              Kembali ke Preview
            </button>
          </div>
        </div>
      </div>      
@endsection

@push('javascript')
    <script>
        const captureBtn = document.getElementById('captureBtn');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const successModal = document.getElementById('successModal');
        const modalCloseBtn = document.getElementById('modalCloseBtn');

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
            // Tampilkan modal
            successModal.classList.remove('hidden');

            // Tombol close modal untuk redirect balik ke halaman preview
            modalCloseBtn.addEventListener('click', () => {
                window.location.href = "{{ route('penagihan.take') }}" +
                    "{{ request()->has('edit') ? '?edit=' . request('edit') : '' }}";
            });
        });

        window.addEventListener('DOMContentLoaded', startCamera);
    </script>
@endpush
