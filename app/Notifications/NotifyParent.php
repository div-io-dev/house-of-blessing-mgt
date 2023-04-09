<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Velstack\Mnotify\Notifications\MnotifyMessage;

class NotifyParent extends Notification
{
    use Queueable;

    public string $message_body;

    public function __construct($message_body)
    {
        $this->message_body = $message_body;
    }

    public function via($notifiable)
    {
        return ['mnotify'];
    }

    public function toMnotify($notifiable)
    {
        return (new  MnotifyMessage())
            ->message($this->message_body);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
