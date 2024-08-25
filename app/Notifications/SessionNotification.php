<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SessionNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $session;
    /**
     * Create a new notification instance.
     */
    public function __construct($session)
    {
        $this->session = $session;
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
        $start_time = $this->session->start_time;
        $end_time = $this->session->end_time;
        return (new MailMessage)
                    ->subject('Next Session Notification')
                    ->greeting(__('Hello :name,', ['name' => $notifiable->name]))
                    ->line("Next session is from $start_time to $end_time")
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [

            'id' => $this->session['id']

        ];
    }

}
