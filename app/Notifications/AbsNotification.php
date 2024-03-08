<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbsNotification extends Notification
{
    use Queueable;

    protected $absNotificationData;

    /**
     * Create a new notification instance.
     */
    public function __construct( $absNotificationData)
    {
     
        $this->absNotificationData = $absNotificationData ;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->view('notifications.abs_notif', [
            'emply' => $this->absNotificationData['emply'],
            'mat' => $this->absNotificationData['mat'],
            'startDate' => $this->absNotificationData['startDate'],
            'endDate' => $this->absNotificationData['endDate'],
            'raisons' => $this->absNotificationData['raisons'],
            'durée' => $this->absNotificationData['durée'],
            'emplEmail' => $this->absNotificationData['empEmail'],
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
