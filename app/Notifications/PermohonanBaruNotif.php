<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermohonanBaruNotif extends Notification
{
    use Queueable;
    public $db;

    /**
     * Create a new notification instance.
     *type ditinjau, revisi, ditolak, disetujui
     * @return void
     */
    public function __construct($saved_db)
    {
        $this->db = $saved_db;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        switch ($this->db->p_status) {
            case 'ditinjau':
                $message = 'Ada Permohonan Rekomenasi Menara Baru';
                break;
            case 'revisi':
                $message =  ucwords('Permohonan Rekomendasi Anda Direvisi');
                break;
            default:
                $message = ucwords('Permohonan Rekomendasi Anda ' . $this->db->p_status);
                break;
        }
        return (new MailMessage)
            ->line($message)
            ->line($this->db->p_alasan_ditolak)
            ->action('Ashiap', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
