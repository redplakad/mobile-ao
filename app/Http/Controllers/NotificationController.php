<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 

class NotificationController extends Controller
{
    /**
     * Pastikan controller ini menggunakan middleware auth.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Menampilkan semua notifikasi user yang belum dibaca.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'Silakan login terlebih dahulu.']);
        }

        $notifications = $user->unreadNotifications;

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Menandai notifikasi sebagai telah dibaca.
     */
    public function markAsRead($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'Silakan login terlebih dahulu.']);
        }

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Menandai semua notifikasi sebagai telah dibaca.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'Silakan login terlebih dahulu.']);
        }

        $user->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
