<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Proses Import Selesai')
                    ->line($this->message)
                    ->action('Lihat Data', url('/'))
                    ->line('Terima kasih telah menggunakan aplikasi ini!');
    }

    /**
     * Store notification in database
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => url('/'), // Ubah ini sesuai dengan URL yang ingin kamu arahkan
        ];
    }
}
