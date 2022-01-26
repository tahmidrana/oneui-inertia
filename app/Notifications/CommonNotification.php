<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommonNotification extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $arr = [
            'title'=> $this->details['title'],
            'text'=> $this->details['text'],
        ];

        if (array_key_exists('name', $this->details)) {
            $arr['name'] = $this->details['name'];
        }

        if (array_key_exists('clinical_session_id', $this->details)) {
            $arr['clinical_session_id'] = $this->details['clinical_session_id'];
        }

        if (array_key_exists('session_discount_id', $this->details)) {
            $arr['session_discount_id'] = $this->details['session_discount_id'];
        }

        if (array_key_exists('client_clinician_assign_request_id', $this->details)) {
            $arr['client_clinician_assign_request_id'] = $this->details['client_clinician_assign_request_id'];
        }

        return $arr;
    }
}
