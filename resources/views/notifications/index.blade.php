@extends('layouts.second')

@section('title', 'Daftar Penagihan')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('front.index') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Notifikasi</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Lihat Notifikasi</p>
        </div>
        <a href="{{ route('dashboard') }}"class="w-10 h-10 flex shrink-0">
            <div class="w-10 h-10 flex shrink-0 ml-4">
                <x-tabler-square-plus />
            </div>
        </a>
    </div>
    <div class="container mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    
        @if ($notifications->isEmpty())
            <div class="text-center text-gray-500">Tidak ada notifikasi baru.</div>
        @else
            <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Tandai Semua Sebagai Dibaca
                </button>
            </form>
    
            <div class="space-y-4">
                @foreach ($notifications as $notification)
                    <div class="p-4 border border-gray-200 rounded-lg flex justify-between items-center bg-white shadow-sm">
                        <div>
                            <p class="text-gray-800">{{ $notification->data['message'] ?? 'Notifikasi baru' }}</p>
                            <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="ml-4 px-3 py-1 text-sm text-white bg-green-500 rounded-lg hover:bg-green-600 transition">
                                Tandai Sebagai Dibaca
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
@endsection
